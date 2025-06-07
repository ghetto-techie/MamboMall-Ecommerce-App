<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        $kenyanBrands = ['Oraimo', 'Samsung', 'Infinix', 'Tecno', 'M-Kopa', 'Safaricom'];
        $name = $this->faker->unique()->randomElement($kenyanBrands);

        // Generate unique slug
        $slug = Str::slug($name);
        $i = 1;
        while (Brand::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $i++;
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'image' => 'brands/' . $this->faker->image('public/storage/brands', 640, 480, 'logo', false),
            'is_active' => true,
        ];
    }
}