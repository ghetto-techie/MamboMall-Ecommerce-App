<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $kenyanProducts = [
            'Oraimo Power Bank 20000mAh',
            'Samsung Galaxy A24',
            'Infinix Hot 30i',
            'Tecno Spark 10',
            'M-Kopa Solar Kit',
            'Safaricom Modem',
            'Men\'s Kitenge Shirt',
            'Kiondo Basket',
            'Kikoy Beach Towel',
            'Kenyan Coffee Beans'
        ];

        $name = $this->faker->unique()->randomElement($kenyanProducts);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->numberBetween(500, 50000),
            'images' => json_encode([
                'products/' . $this->faker->image('public/storage/products', 800, 600, 'product', false),
                'products/' . $this->faker->image('public/storage/products', 800, 600, 'product', false),
            ]),
            'is_active' => $this->faker->boolean(90),
            'is_featured' => $this->faker->boolean(20),
            'in_stock' => $this->faker->boolean(85),
            'on_sale' => $this->faker->boolean(30),
            'category_id' => null, // Will be set in seeder
            'brand_id' => null, // Will be set in seeder
        ];
    }
}