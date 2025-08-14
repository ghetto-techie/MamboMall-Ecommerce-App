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
            // Smartphones
            'Samsung',
            'Apple',
            'Infinix',
            'Tecno',
            'Oppo',
            'Xiaomi',
            'Realme',
            'Huawei',
            'Nokia',

            // Laptops & Computers
            'HP',
            'Dell',
            'Lenovo',
            'Asus',
            'Acer',
            'Microsoft Surface',
            'Apple MacBook',

            // Accessories & Peripherals
            'Logitech',
            'Sony',
            'Canon',
            'Epson',
            'JBL',
            'Anker',

            // Networking & Storage
            'TP-Link',
            'D-Link',
            'Seagate',
            'Western Digital',

            // TVs & Home Electronics
            'LG',
            'Samsung TV',
            'Sony Bravia',
            'Hisense',
            'Skyworth',
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(
                ['name' => $brandName],
                ['slug' => Str::slug($brandName)]
            );
        }
    }
}
