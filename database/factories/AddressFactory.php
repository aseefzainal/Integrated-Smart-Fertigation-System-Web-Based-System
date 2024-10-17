<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line_1' => fake()->streetAddress,
            'address_line_2' => fake()->optional()->streetAddress,
            'city' => fake()->city,
            'state' => fake()->state,
            'postcode' => fake()->postcode,
            'country' => fake()->country,
            'addressable_id' => null, // Set this to null or a default value if needed
            'addressable_type' => null, // Set this to null or a default value if needed
            'address_type' => $this->faker->randomElement(['home', 'site']), // Randomly assign home or site
        ];
    }
}
