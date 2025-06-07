<?php

// database/factories/AddressFactory.php
namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
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

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => '+2547' . $this->faker->numberBetween(10000000, 99999999),
            'city' => $this->faker->randomElement($kenyanCounties),
            'state' => $this->faker->randomElement($kenyanCounties),
            'zip_code' => '00' . $this->faker->numberBetween(100, 999),
            'street_address' => $this->faker->streetAddress,
            'order_id' => null, // Will be set in seeder
        ];
    }
}