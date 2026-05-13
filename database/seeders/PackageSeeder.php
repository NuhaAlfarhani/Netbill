<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'package' => 'Basic',
            'price' => 100000,
            'speed' => '10 Mbps',
            'description' => 'Paket Basic dengan kecepatan 10 Mbps, cocok untuk penggunaan internet ringan seperti browsing dan media sosial.'
        ]);
        Package::create([
            'package' => 'Standard',
            'price' => 200000,
            'speed' => '20 Mbps',
            'description' => 'Paket Standard dengan kecepatan 20 Mbps, cocok untuk penggunaan internet sedang seperti streaming video dan gaming.'
        ]);
        Package::create([
            'package' => 'Premium',
            'price' => 300000,
            'speed' => '30 Mbps',
            'description' => 'Paket Premium dengan kecepatan 30 Mbps, cocok untuk penggunaan internet berat seperti streaming 4K dan gaming online.'
        ]);
    }
}
