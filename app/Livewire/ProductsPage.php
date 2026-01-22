<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

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
    public $min_price = 0;

    #[Url]
    public $max_price = 500000; // Default max price

    #[Url]
    public $q = '';

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function updatingMinPrice()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset([
            'selected_categories',
            'selected_brands',
            'featured',
            'on_sale',
            'min_price',
            'max_price',
            'sort',
            'q'
        ]);
        $this->min_price = 0;
        $this->max_price = 500000;
        $this->sort = 'latest';
        $this->resetPage();
    }

    // Add product to cart
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count)
             ->to(Navbar::class);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        // Apply category filter
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        // Apply brand filter
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        // Featured filter
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        // On sale filter
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        // Price filters
        if ($this->min_price) {
            $productQuery->where('price', '>=', $this->min_price);
        }
        if ($this->max_price) {
            $productQuery->where('price', '<=', $this->max_price);
        }

        // Search filter
        if ($this->q) {
            $search = $this->q;
            $productQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhereHas('brand', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      });
            });
        }

        // Sorting
        if ($this->sort === 'latest') {
            $productQuery->latest();
        } elseif ($this->sort === 'price_low') {
            $productQuery->orderBy('price', 'asc');
        } elseif ($this->sort === 'price_high') {
            $productQuery->orderBy('price', 'desc');
        }

        $brands = Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(30)->withQueryString(),
            'brands' => $brands,
            'categories' => $categories
        ]);
    }
}
