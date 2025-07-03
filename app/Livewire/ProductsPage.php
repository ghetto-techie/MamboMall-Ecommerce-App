<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Products')]
class ProductsPage extends Component
{
    use WithPagination;
    
    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        $brands = Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);
        return view('livewire.products-page', ['products' => $productQuery->paginate(15), 'brands' => $brands, 'categories' => $categories]);
    }
}
