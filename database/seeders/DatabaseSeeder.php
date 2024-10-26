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
use App\Models\SensorNotification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     SettingSeeder::class,
        //     RoleSeeder::class,
        //     UserSeeder::class,
        //     ProjectCategorySeeder::class,
        //     ProjectSeeder::class,
        //     InputSeeder::class,
        //     SensorSeeder::class,
        // ]);

        // User::factory(6)->create()->each(function ($user) {
        //     // Address::factory()->create(['user_id' => $user->id]);
        //     Address::factory()->create([
        //         'addressable_id' => $user->id,
        //         'addressable_type' => User::class, // Specify the User class for polymorphic relationship
        //         'address_type' => 'home', // You can specify the address type if needed
        //     ]);
        // });

        // $userIds = User::pluck('id')->toArray();

        // $predefinedInputs = Input::all();
        $predefinedSensors = Sensor::all();

        // for ($i = 0; $i < 38; $i++) {
        //     $project = Project::create([
        //         'user_id' => fake()->randomElement($userIds),
        //         'name' => fake()->sentence(3),
        //         'category_id' => 1,
        //         'slug' => Str::slug(fake()->sentence(3)),
        //     ]);

        //     foreach ($predefinedInputs as $input) {
        //         ProjectInput::create([
        //             'project_id' => $project->id,
        //             'input_id' => $input->id,
        //             'custom_name' => $input->name,
        //             'status' => rand(0, 1)
        //         ]);
        //     }

        //     Address::factory()->create([
        //         'addressable_id' => $project->id,
        //         'addressable_type' => Project::class, // Specify the User class for polymorphic relationship
        //         'address_type' => 'site', // You can specify the address type if needed
        //     ]);
        // }

        // Schedule::factory(100)->create();

        foreach($predefinedSensors as $sensor) {
            ProjectSensor::create([
                'project_id' => 44,
                'sensor_id' => $sensor->id,
                'value' => rand(0, 200)
            ]);
        }

        // foreach($predefinedSensors as $sensor) {
        //     SensorNotification::create([
        //         'project_id' => 44,
        //         'sensor_id' => $sensor->id,
        //     ]);
        // }
    }
}
