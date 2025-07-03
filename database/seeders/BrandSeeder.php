<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand; // Make sure your Brand model is correctly namespaced
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'TechGuru',
            'Fashionista',
            'HomeComfort',
            'BookWorm',
            'SportPro',
            'Glamour',
            'PlayTime',
            'AutoZone',
            'WellnessCo',
            'PetPals'
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(
                ['name' => $brandName],
                ['slug' => Str::slug($brandName)]
            );
        }
    }
}
