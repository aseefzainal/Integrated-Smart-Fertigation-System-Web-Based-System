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
                'default_value' => 'light',
            ],
            [
                'name' => 'countdown',
                'default_value' => 5
            ],
            [
                'name' => 'sensor_notification',
                'default_value' => json_encode([
                    ['name' => 'SMS', 'status' => false, 'category' => 'pay', 'price' => 'RM0.20/sms'],
                    ['name' => 'WhatsApp', 'status' => false, 'category' => 'pay', 'price' => 'RM5.00/month'],
                    ['name' => 'Telegram', 'status' => true, 'category' => 'free', 'price' => 'RM0.00/-'],
                    ['name' => 'Email', 'status' => false, 'category' => 'free', 'price' => 'RM0.00/-'],
                ]),
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
