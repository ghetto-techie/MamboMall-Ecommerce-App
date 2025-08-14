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
            // Phones & Tablets
            'Smartphones',
            'Feature Phones',
            'Tablets',
            'Smartwatches',
            'Phone Accessories',

            // Computers & Laptops
            'Laptops',
            'Desktops',
            'Monitors',
            'Computer Accessories',
            'Printers & Scanners',
            'Networking Equipment',

            // Storage Devices
            'External Hard Drives',
            'Flash Drives',
            'Memory Cards',

            // Audio & Video
            'Televisions',
            'Home Theatre Systems',
            'Headphones & Earphones',
            'Bluetooth Speakers',

            // Cameras & Photography
            'Digital Cameras',
            'DSLR Cameras',
            'Camera Accessories',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName)]
            );
        }
    }
}
