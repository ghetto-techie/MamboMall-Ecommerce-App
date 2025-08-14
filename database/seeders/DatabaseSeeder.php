<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@ghettotechie.co.ke',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
        ]);

        // Create an admin user, email is default for admin panel
        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin User',
            'email' => 'admin@ghettotechie.co.ke',
            'email_verified_at' => now(),
            'password' => bcrypt('admin@123'),
        ]);

        User::factory(10)->withPersonalTeam()->create();

        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
