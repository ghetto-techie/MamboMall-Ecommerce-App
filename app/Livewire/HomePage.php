<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Home')]
class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', 1)->paginate(8);
        $categories = Category::where('is_active', 1)->paginate(8);
        $featuredProducts = Product::where('is_featured', 1)->latest()->paginate(4);
        return view('livewire.home-page', ['brands' => $brands, 'categories' => $categories, 'featuredProducts' => $featuredProducts]);
    }
}
