<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class, ProjectSeeder::class, InputSeeder::class]);
        
        User::factory(17)->create()->each(function ($user) {
            Address::factory()->create(['user_id' => $user->id]);
        });     
        
        $userIds = User::pluck('id')->toArray();

        for($i = 0; $i < 38; $i++) {
            Project::create([
                'user_id' => fake()->randomElement($userIds),
                'name' => fake()->sentence(3),
                'slug' => Str::slug(fake()->sentence(3)),
            ]);
        }
    }
}
