<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'theme',
                'default_value' => 'light'
            ],
            [
                'name' => 'sensor_notification',
                'default_value' => json_encode([
                    'sms' => false,
                    'telegram' => false,
                    'whatsapp' => true,
                    'email' => false,  // Default to email enabled
                ]),
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
