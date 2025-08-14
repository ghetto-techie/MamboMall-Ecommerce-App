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

        // Use the same image files you had before
        $imageFiles = [
            '01JWQRNW8J7P7SXFGY7BA1FGAJ.webp',
            '01JWQSM8V6GC9A382F2DYRCYY1.jpg',
            '01JWQT3XCE7H31JASCMCCGAAFA.webp',
            '01JWRH7QZ6JCGWNTK9DKW5MQCQ.jpg',
            'LuP7afRdGB1UvO5JOB6b2l473e2Yx1J46XlGsqOx.png',
        ];

        // Popular electronics products in Kenya
        $productNames = [
            // Smartphones
            'Samsung Galaxy A15', 'Samsung Galaxy S24 Ultra', 'Apple iPhone 15 Pro Max',
            'Tecno Camon 20 Premier', 'Infinix Zero Ultra', 'Oppo Reno 10', 'Xiaomi Redmi Note 13 Pro',
            'Realme C67', 'Huawei Nova 11', 'Nokia G60 5G',

            // Laptops
            'HP Pavilion 15', 'HP EliteBook 840', 'Dell Inspiron 15', 'Dell XPS 13',
            'Lenovo ThinkPad X1 Carbon', 'Asus ZenBook 14', 'Acer Aspire 5',
            'Microsoft Surface Laptop 5', 'Apple MacBook Air M2', 'Apple MacBook Pro 14 M3',

            // TVs & Accessories
            'LG OLED 55 Inch 4K Smart TV', 'Samsung 65 Inch QLED 4K TV', 'Sony Bravia 55 Inch Android TV',
            'Hisense 50 Inch UHD Smart TV', 'Skyworth 43 Inch LED TV',

            // Audio & Gadgets
            'JBL Flip 6 Bluetooth Speaker', 'Sony WH-1000XM5 Headphones',
            'Anker Soundcore Liberty 3 Pro Earbuds', 'Logitech MX Master 3S Mouse',
            'Canon EOS 90D DSLR Camera', 'Epson EcoTank L3250 Printer'
        ];

        // Seed products
        for ($i = 0; $i < 50; $i++) {
            $productName = $faker->randomElement($productNames);
            $randomImagePath = 'products/' . $faker->randomElement($imageFiles);

            Product::create([
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'name' => $productName,
                'slug' => Str::slug($productName . '-' . $i),
                'images' => [$randomImagePath],
                'description' => $faker->sentence(10) . ' ' . $faker->sentence(12),
                'price' => $faker->randomFloat(2, 2000, 350000), // Electronics price range
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
