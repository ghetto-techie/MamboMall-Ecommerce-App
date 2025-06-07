<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'unit_amount' => fn(array $attributes) => Product::find($attributes['product_id'])->price,
            'total_amount' => fn(array $attributes) =>
                $attributes['quantity'] * Product::find($attributes['product_id'])->price,
            'order_id' => null, // Set in seeder
            'product_id' => Product::factory(),
        ];
    }
}