<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sensors = [
            [
                'name' => 'EC Meter Sensor',
                'slug' => 'ec',
                'unit' => 'mS/cm'
            ],
            [
                'name' => 'Float AB Sensor',
                'slug' => 'float-ab-digital',
                'min_value' => 'LOW',
                'max_value' => 'HIGH'
            ],
            [
                'name' => 'Float AB Sensor',
                'slug' => 'float-ab-percentage',
                'unit' => '%',
                'min_value' => '30',
                'max_value' => '100'
            ],
            [
                'name' => 'Water Temperature Sensor',
                'slug' => 'water-temperature',
                'unit' => '°C',
                'min_value' => '24',
                'max_value' => '27'
            ],
            [
                'name' => 'Soil Sensor 1',
                'slug' => 'soil-1',
                'min_value' => 'DRY',
                'max_value' => 'WET'
            ],
            [
                'name' => 'Soil Sensor 2',
                'slug' => 'soil-2',
                'min_value' => 'DRY',
                'max_value' => 'WET'
            ],
            [
                'name' => 'Soil Sensor 3',
                'slug' => 'soil-3',
                'min_value' => 'DRY',
                'max_value' => 'WET'
            ],
        ];

        foreach($sensors as $sensor) {
            Sensor::create($sensor);
        }
    }
}
