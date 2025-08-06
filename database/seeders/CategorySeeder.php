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
            'Beer',
            'Lager',
            'Stout',
            'Cider',
            'Whisky',
            'Vodka',
            'Gin',
            'Rum',
            'Brandy',
            'Traditional Brews',
            'Wine',
            'Rum',
            'Sprits',
            'Custom'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
        }
    }
}
