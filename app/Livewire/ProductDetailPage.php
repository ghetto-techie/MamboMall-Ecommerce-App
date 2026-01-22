<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use App\Services\ProductRecommender;  // Add this import
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Product Detail')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;
    public $recommendations = [];  // Add this property for recommendations

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

    public function mount($slug)
    {
        $this->slug = $slug;

        // Load product and recommendations
        $product = Product::where('slug', $slug)->firstOrFail();

        // Initialize recommendation service and get similar products
        $recommender = new ProductRecommender();
        $this->recommendations = $recommender->getSimilarProducts($product, 6);
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail()
        ]);
    }
}
