<?php

namespace Database\Seeders;

use App\Models\SubscriptionPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Basic',
                'description' => '-',
                'price' => 15000.00,
                'duration' => 0,
                'features' => json_encode([
                    ['-' => '-'],
                    ['-' => '-'],
                    ['-' => '-'],
                ])
            ],
            [
                'name' => 'Standard',
                'description' => '-',
                'price' => 30000.00,
                'duration' => 0,
                'features' => json_encode([
                    ['-' => '-'],
                    ['-' => '-'],
                    ['-' => '-'],
                ])
            ],
            [
                'name' => 'Premium',
                'description' => '-',
                'price' => 45000.00,
                'duration' => 0,
                'features' => json_encode([
                    ['-' => '-'],
                    ['-' => '-'],
                    ['-' => '-'],
                ])
            ]
        ];

        foreach ($packages as $package) {
            SubscriptionPackage::create($package);
        }
    }
}
