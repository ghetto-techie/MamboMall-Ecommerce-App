<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Sneakers',
            'Running Shoes',
            'Basketball Shoes',
            'Casual Wear',
            'Boots',
            'Slides & Sandals',
            'Streetwear',
            'Luxury',
            'Kids',
            'Women',
            'Men',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
        }
    }
}
