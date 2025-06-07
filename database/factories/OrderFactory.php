<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'grand_total' => 0, // Will be calculated later
            'payment_method' => $this->faker->randomElement(['stripe', 'cod', 'payhero']),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'status' => $this->faker->randomElement(['new', 'processing', 'shipped', 'delivered']),
            'currency' => 'kes',
            'shipping_amount' => $this->faker->numberBetween(200, 1500),
            'shipping_method' => $this->faker->randomElement(['fedex', 'ups', 'sendy', 'aerobatics']),
            'notes' => $this->faker->boolean(30) ? $this->faker->sentence : '',
        ];
    }
}