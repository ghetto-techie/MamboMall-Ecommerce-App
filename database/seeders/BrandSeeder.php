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
            'Nike',
            'Adidas',
            'Puma',
            'New Balance',
            'Reebok',
            'Jordan',
            'Converse',
            'Vans',
            'Timberland',
            'Fila',
            'Skechers',
            'Asics',
            'Under Armour',
            'Balenciaga',
            'Gucci',
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(
                ['name' => $brandName],
                ['slug' => Str::slug($brandName)]
            );
        }
    }
}
