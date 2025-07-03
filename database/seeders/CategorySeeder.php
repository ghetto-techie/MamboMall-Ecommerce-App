<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Make sure your Category model is correctly namespaced
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Electronics',
            'Clothing',
            'Home & Kitchen',
            'Books',
            'Sports & Outdoors',
            'Beauty & Personal Care',
            'Toys & Games',
            'Automotive',
            'Health & Household',
            'Pet Supplies'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
        }
    }
}
