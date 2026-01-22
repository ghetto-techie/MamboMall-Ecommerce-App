<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ensure categories & brands exist
        $categoryIds = Category::pluck('id')->toArray();
        $brandIds = Brand::pluck('id')->toArray();

        if (empty($categoryIds)) {
            $this->call(CategorySeeder::class);
            $categoryIds = Category::pluck('id')->toArray();
        }
        if (empty($brandIds)) {
            $this->call(BrandSeeder::class);
            $brandIds = Brand::pluck('id')->toArray();
        }

        // Example product images (replace with your real images inside storage/app/public/products/)
        $imageFiles = [
            'air_force_1.jpg',
            'jordan_1_retro.jpg',
            'yeezy_boost_350.jpg',
            'converse_chuck_taylor.jpg',
            'puma_suede.jpg',
            'timberland_boot.jpg',
            'balenciaga_triple_s.jpg',
            'gucci_ace.jpg',
        ];

        // Popular product names
        $productNames = [
            'Nike Air Force 1',
            'Nike Air Max 90',
            'Nike Dunk Low',
            'Air Jordan 1 Retro',
            'Adidas Yeezy Boost 350',
            'Adidas Ultraboost',
            'Puma Suede Classic',
            'New Balance 550',
            'Converse Chuck Taylor All Star',
            'Vans Old Skool',
            'Timberland Premium 6-Inch Boot',
            'Fila Disruptor II',
            'Skechers D’Lites',
            'Asics Gel-Kayano',
            'Under Armour Curry Flow',
            'Balenciaga Triple S',
            'Gucci Ace Sneaker',
        ];

        // Seed products
        foreach ($productNames as $i => $productName) {
            $randomImagePath = 'products/' . $faker->randomElement($imageFiles);

            Product::create([
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'name' => $productName,
                'slug' => Str::slug($productName . '-' . $i),
                'images' => [$randomImagePath],
                'description' => $faker->sentence(10) . ' ' . $faker->sentence(12),
                'price' => $faker->randomFloat(2, 2500, 50000), // Typical sneaker price range in KES
                'is_active' => $faker->boolean(95),
                'is_featured' => $faker->boolean(40),
                'in_stock' => $faker->boolean(90),
                'on_sale' => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
