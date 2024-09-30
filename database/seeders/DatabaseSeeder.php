<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Input;
use App\Models\Sensor;
use App\Models\Address;
use App\Models\Project;
use App\Models\Schedule;
use Illuminate\Support\Str;
use App\Models\ProjectInput;
use App\Models\ProjectSensor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class, ProjectSeeder::class, InputSeeder::class, SensorSeeder::class]);

        User::factory(17)->create()->each(function ($user) {
            Address::factory()->create(['user_id' => $user->id]);
        });

        $userIds = User::pluck('id')->toArray();

        $predefinedInputs = Input::all();
        $predefinedSensors = Sensor::all();

        for ($i = 0; $i < 38; $i++) {
            $project = Project::create([
                'user_id' => fake()->randomElement($userIds),
                'name' => fake()->sentence(3),
                'slug' => Str::slug(fake()->sentence(3)),
            ]);
            
            foreach ($predefinedInputs as $input) {
                ProjectInput::create([
                    'project_id' => $project->id,
                    'input_id' => $input->id,
                    'custom_name' => $input->name,
                    'status' => rand(0, 1)
                ]);
            }

            // for($j = 0; $j < 5; $j++) {
            //     foreach($predefinedSensors->random(5) as $sensor) {
            //         SensorReading::create([
            //             'project_id' => $project->id,
            //             'sensor_id' => $sensor->id,
            //             'value' => rand(0, 200)
            //         ]);
            //     }
            // }
        }

        Schedule::factory(100)->create();

        // foreach($predefinedSensors as $sensor) {
        //     ProjectSensor::create([
        //         'project_id' => 1,
        //         'sensor_id' => $sensor->id,
        //         'value' => rand(0, 200)
        //     ]);
        // }
    }
}
