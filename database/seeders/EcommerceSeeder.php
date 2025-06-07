<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EcommerceSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        OrderItem::truncate();
        Address::truncate();
        Order::truncate();
        Product::truncate();
        Brand::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create categories
        $categories = Category::factory(5)->create();

        // Create brands
        $brands = Brand::factory(4)->create();

        // Create products
        $products = Product::factory(50)->create([
            'category_id' => fn() => $categories->random()->id,
            'brand_id' => fn() => $brands->random()->id,
        ]);

        // Create test user
        $user = User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Test Customer',
                'password' => bcrypt('password'),
            ]
        );

        // Create orders
        $orders = Order::factory(20)->create([
            'user_id' => $user->id,
            'currency' => 'kes',
            'shipping_amount' => rand(200, 1500),
        ]);

        // Create order items
        $orders->each(function ($order) use ($products) {
            $itemsCount = rand(1, 5);
            $selectedProducts = $products->random($itemsCount);

            $selectedProducts->each(function ($product) use ($order) {
                $quantity = rand(1, 3);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_amount' => $product->price,
                    'total_amount' => $quantity * $product->price,
                ]);
            });

            // Update order grand total
            $order->update([
                'grand_total' => $order->items->sum('total_amount') + $order->shipping_amount
            ]);
        });

        // Create addresses
        $kenyanCounties = [
            'Nairobi',
            'Mombasa',
            'Kisumu',
            'Nakuru',
            'Eldoret',
            'Thika',
            'Kakamega',
            'Kisii',
            'Meru',
            'Nyeri'
        ];

        $orders->each(function ($order) use ($kenyanCounties) {
            Address::create([
                'order_id' => $order->id,
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'phone' => fake()->phoneNumber,
                'city' => fake()->randomElement($kenyanCounties),
                'state' => fake()->randomElement($kenyanCounties),
                'zip_code' => '00' . rand(100, 999),
                'street_address' => fake()->streetAddress,
            ]);
        });

        $this->command->info('✅ E-commerce data seeded successfully!');
        $this->command->info('👤 Test User: customer@example.com / password');
    }
}