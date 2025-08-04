<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use PHPUnit\Runner\Filter\TestIdFilterIterator;

#[Layout('layouts.app')]
#[Title('Products')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $sort = 'latest';

    #[Url]
    public $min_price;

    #[Url]
    public $max_price = 1000000; // Default max price

    public function resetFilters()
    {
        $this->selected_categories = [];
        $this->selected_brands = [];
        $this->featured = null;
        $this->on_sale = null;
        $this->min_price = null;
        $this->max_price = 1000000; // Reset to default
    }

    // Add product to cart
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);
        $this
            ->dispatch('update-cart-count', total_count:$total_count)
            ->to(Navbar::class)
        ;
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->sort === 'latest') {
            $productQuery->latest();
        } elseif ($this->sort === 'price_low') {
            $productQuery->orderBy('price', 'asc');
        } elseif ($this->sort === 'price_high') {
            $productQuery->orderBy('price', 'desc');
        }
        // TODO: Implement sorting by popularity and rating if needed
        // elseif ($this->sort === 'popularity') {
        //     $productQuery->orderBy('views', 'desc');
        // } elseif ($this->sort === 'rating') {
        //     $productQuery->orderBy('rating', 'desc');
        // }

        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }
        if ($this->min_price) {
            $productQuery->where('price', '>=', $this->min_price);
        }
        if ($this->max_price) {
            $productQuery->where('price', '<=', $this->max_price);
        }
        $brands = Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);
        return view(
            'livewire.products-page', 
            [
                'products' => $productQuery->paginate(15), 
                'brands' => $brands, 
                'categories' => $categories
            ]
        );
    }
}
