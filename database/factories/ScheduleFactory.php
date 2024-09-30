<?php

namespace Database\Factories;

use App\Models\ProjectInput;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectInput = ProjectInput::whereIn('input_id', [1, 2])->inRandomOrder()->first();

        return [

                'project_input_id' => $projectInput->id,
                'hst' => 'HST-' . fake()->numberBetween(1, 100),
                'date' => fake()->dateTime()->format('Y-m-d'), 
                'time' => fake()->dateTime()->format('H:i:s'), 
                'status' => fake()->boolean,
        ];
    }
}
