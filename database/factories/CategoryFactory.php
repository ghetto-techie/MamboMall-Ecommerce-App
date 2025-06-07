<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = ['Electronics', 'Fashion', 'Home & Kitchen', 'Beauty', 'Sports'];
        $name = $this->faker->unique()->randomElement($categories);

        // Generate unique slug
        $slug = Str::slug($name);
        $i = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $i++;
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'image' => 'categories/' . $this->faker->image('public/storage/categories', 640, 480, null, false),
            'is_active' => true,
        ];
    }
}