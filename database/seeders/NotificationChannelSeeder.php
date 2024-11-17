<?php

namespace Database\Seeders;

use App\Models\NotificationChannel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'name' => 'SMS',
                'is_enable' => false,
                'category' => 'pay',
                'price' => 'RM0.20/sms'
            ],
            [
                'name' => 'WhatsApp',
                'is_enable' => false,
                'category' => 'pay',
                'price' => 'RM5.00/month'
            ],
            [
                'name' => 'Telegram',
                'is_enable' => true,
                'category' => 'free',
                'price' => 'RM0.00/-'
            ],
            [
                'name' => 'Email',
                'is_enable' => false,
                'category' => 'free',
                'price' => 'RM0.00/-'
            ],
        ];

        foreach($notifications as $notification) {
            NotificationChannel::create($notification);
        }
    }
}
