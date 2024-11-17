<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SmsNotification>
 */
class SmsNotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'message' => $this->faker->sentence(12), // Random message
            'sent_at' => $this->faker->dateTimeBetween('-12 month', 'now'), // Random timestamp
        ];
    }
}
