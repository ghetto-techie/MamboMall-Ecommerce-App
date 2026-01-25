<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use App\Models\ProductReview;
use App\Services\ProductRecommender;  // Add this import
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Product Detail')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;
    public $recommendations = [];
    public $rating = 5;
    public $comment = '';
    public Product $product;

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);
        $this
            ->dispatch('update-cart-count', total_count:$total_count)
            ->to(Navbar::class);
    }
    public function submitReview()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        $product = Product::where('slug', $this->slug)->firstOrFail();

        $existingReview = ProductReview::where('product_id', $product->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($existingReview) {
            $this->addError('comment', 'You have already reviewed this product.');
            return;
        } else {
            ProductReview::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'user_id'    => Auth::user()->id,
                ],
                [
                    'rating'      => $this->rating,
                    'comment'     => $this->comment,
                    'is_approved' => false, // re-approval required
                ]
            );

            $this->reset(['rating', 'comment']);
            $this->loadProduct();

            // Force UI feedback
            $this->dispatch('review-submitted');
        }
    }

    protected function loadProduct(): void
    {
        $this->product = Product::where('slug', $this->slug)
            ->with([
                'approvedReviews.user',
            ])
            ->firstOrFail();
    }


    public function mount($slug)
    {
        $this->slug = $slug;

        // Load product and recommendations
        $this->loadProduct();

        // Initialize recommendation service and get similar products
        $recommender = new ProductRecommender();
        $this->recommendations = $recommender->getSimilarProducts($this->product, 6);
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product
        ]);
    }
}
