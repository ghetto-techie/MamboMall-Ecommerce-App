<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category; // Import Category model to get IDs
use App\Models\Brand;    // Import Brand model to get IDs
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all category and brand IDs
        $categoryIds = Category::pluck('id')->toArray();
        $brandIds = Brand::pluck('id')->toArray();

        // Ensure we have categories and brands
        if (empty($categoryIds)) {
            $this->call(CategorySeeder::class);
            $categoryIds = Category::pluck('id')->toArray();
        }
        if (empty($brandIds)) {
            $this->call(BrandSeeder::class);
            $brandIds = Brand::pluck('id')->toArray();
        }

        // List of your image filenames
        $imageFiles = [
            '01JWQRNW8J7P7SXFGY7BA1FGAJ.webp', '01JWQSM8V6GC9A382F2DYRCYY1.jpg',
            '01JWQT3XCE7H31JASCMCCGAAFA.webp', '01JWRH7QZ6JCGWNTK9DKW5MQCQ.jpg',
            '01JWRJ8CS8JKDCNZP8ZXSR9ZGZ.jpg', '01JWQRNW9CBB7EDBFB9G42VZWQ.webp',
            '01JWQSM8VBBM7C17R78RPG3M3P.jpg', '01JWQT3XCJWRJPN8NTPN8KB5YV.webp',
            '01JWRJ47VM9FB002BFENEFVVEY.webp', '01JWRJ8CSD13ANV8TWKYEC1KWZ.jpg',
            '01JWQRNW9H0WZCTJBYY424GHRX.jpg', '01JWQSM8VGR41ARD3GW70TJDFX.jpg',
            '01JWQVPDF9BFYADMF2BJKGHZN9.webp', '01JWRJ47VV77ZPKMXNW3QN0EV3.webp',
            '01JX7FYSRFE551BK7NRNYYAG7Y.jpg', '01JWQRNW9PZ1T1W7QE4Q6G8X8A.jpg',
            '01JWQSM8VM6CCRTBVMC5ZRHZTM.jpg', '01JWQVPDFFD5JH9WYGZTHCWXVV.webp',
            '01JWRJ47VZBDB47N12K8BF24BN.webp', '01JX7FYSRR3D736Y7NN0S5TMR8.jpg',
            '01JWQRVNG6RYMC2XY4REY739TD.webp', '01JWQSM8VT3YAAPYG0SY5VH1SX.jpg',
            '01JWQVPDFM22Y5TJW72JPMQV3F.webp', '01JWRJ47W392361WPVVGCMX0J8.webp',
            '01JX7GBTWT0NW4QZ6158AW9KBR.jpg', '01JWQRVNGDNV7MEPT4PD9DZBH6.webp',
            '01JWQST7ZKZ6P0NQPVY8GG8T29.jpg', '01JWQVPDFS3TD0X2P9SP7TEQYY.webp',
            '01JWRJ8CRSSG6TC1K9ZDF1EDBF.jpg', '01JX7GBTX03P39SFTFTZE56P30.jpg',
            '01JWQRVNGKY3JVC2PBMTQPDHC8.jpg', '01JWQT3XBVE550YZNPVBP4RKE9.webp',
            '01JWRH7QYRZXXEQNCGTM8KTEK4.webp', '01JWRJ8CRYN9A3R80KA269G795.jpg',
            '01JWQRVNGSPTE19RGPJPB79SS7.jpg', '01JWQT3XC0P7QKWE2Z2ZDSK4RD.webp',
            '01JWRH7QZ1TP9JGRAH096R9D5G.webp', '01JWRJ8CS3JXGBYW4ADRN6ARVB.jpg',
            'LuP7afRdGB1UvO5JOB6b2l473e2Yx1J46XlGsqOx.png',
        ];

        for ($i = 0; $i < 50; $i++) {
            $productName = 'Product ' . ($i + 1) . ' ' . $faker->words(2, true); // Generate unique product names
            $randomImagePath = 'products/' . $imageFiles[array_rand($imageFiles)];

            Product::create([
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'name' => $productName,
                'slug' => Str::slug($productName),
                'images' => [$randomImagePath], // Store as an array with one image path
                'description' => $faker->paragraph(rand(3, 8)), // Generate a paragraph for description
                'price' => $faker->randomFloat(2, 50, 1000), // Price between 50.00 and 1000.00
                'is_active' => $faker->boolean(90), // 90% chance to be active
                'is_featured' => $faker->boolean(30), // 30% chance to be featured
                'in_stock' => $faker->boolean(95), // 95% chance to be in stock
                'on_sale' => $faker->boolean(20), // 20% chance to be on sale
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
