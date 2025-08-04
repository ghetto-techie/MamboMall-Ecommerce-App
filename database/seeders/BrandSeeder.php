<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            // Mainstream beers (EABL)
            'Tusker',
            'Tusker Malt',
            'Tusker Lite',
            'White Cap',
            'Pilsner',
            'Guinness',
            'Jack Daniels', // Added Jack Daniels as a popular brand
            'Hunter',
            'Hennessy', 
            'Kenya Cane', 
            'Smirnoff', 
            'Gordon\'s', 
            'Captain Morgan', 
            'General Medley', 
            'Bacardi', 
            'Malibu', 
            'Absolut', 
            'Ciroc', 
            'Belvedere',
            // Local / regional brews
            'Summit Lager',
            'Senator',
            // Craft & microbrews
            '254 Brewing Co',
            'Kenyan Originals',
            'Procera Gin',
            // Spirits from Keroche
            'Crescent Gin',
            'Crescent Vodka',
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(
                ['name' => $brandName],
                ['slug' => Str::slug($brandName)]
            );
        }
    }
}
