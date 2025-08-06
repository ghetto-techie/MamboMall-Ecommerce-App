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

        $imageFiles = [
            '01JWQRNW8J7P7SXFGY7BA1FGAJ.webp', '01JWQSM8V6GC9A382F2DYRCYY1.jpg',
            '01JWQT3XCE7H31JASCMCCGAAFA.webp', '01JWRH7QZ6JCGWNTK9DKW5MQCQ.jpg',
            'LuP7afRdGB1UvO5JOB6b2l473e2Yx1J46XlGsqOx.png',
            // Add more or replace with actual alcohol product images later
        ];

        $kenyanAlcoholNames = [
            'Tusker Lager', 'Tusker Lite', 'Tusker Malt',
            'White Cap Lager', 'Guinness Foreign Extra',
            'Summit Lager', 'Senator Keg', 'Crescent Vodka',
            'Crescent Gin', '254 Pale Ale', 'Kenyan Originals Apple Cider',
            'Procera African Juniper Gin', 'Changaa Premium',
            'Muratina Local Brew', 'Kingfisher Berry Wine',
            'Jebel Gin', 'Sierra Amber Ale', 'Chrome Vodka',
        ];

        for ($i = 0; $i < 50; $i++) {
            $productName = $faker->randomElement($kenyanAlcoholNames) . ' ' . $faker->numerify('#L###');
            $randomImagePath = 'products/' . $imageFiles[array_rand($imageFiles)];

            Product::create([
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'name' => $productName,
                'slug' => Str::slug($productName),
                'images' => [$randomImagePath],
                'description' => $faker->sentence() . ' Best served chilled. ' . $faker->sentence(),
                'price' => $faker->randomFloat(2, 100, 15500), // realistic alcohol price range
                'is_active' => $faker->boolean(90),
                'is_featured' => $faker->boolean(40),
                'in_stock' => $faker->boolean(95),
                'on_sale' => $faker->boolean(25),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
