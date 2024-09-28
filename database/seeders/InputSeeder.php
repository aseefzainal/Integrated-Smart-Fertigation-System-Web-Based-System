<?php

namespace Database\Seeders;

use App\Models\Input;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                'name' => 'Water Irrigation',
                'slug' => 'water-irrigation',
                'type' => 'auto',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'Fertilizer Irrigation',
                'slug' => 'fertilizer-irrigation',
                'type' => 'auto',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'M1',
                'slug' => 'm1',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'M2',
                'slug' => 'm2',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'M3',
                'slug' => 'm3',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'V2',
                'slug' => 'v2',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'V3',
                'slug' => 'v3',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'V4',
                'slug' => 'v4',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
            [
                'name' => 'V5',
                'slug' => 'v5',
                'type' => 'manual',
                'description' => 'This input will automatically turn off when soil is moisture'
            ],
        ];

        foreach($inputs as $input) {
            Input::create($input);
        }
    }
}
