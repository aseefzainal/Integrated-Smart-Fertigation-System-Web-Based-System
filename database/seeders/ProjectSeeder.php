<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'name' => 'Final Year Project',
                'slug' => 'fyp'
            ],
            [
                'user_id' => 2,
                'category_id' => 1,
                'name' => 'Telong Site',
                'slug' => 'telong-site'
            ],
            [
                'user_id' => 3,
                'category_id' => 1,
                'name' => 'Kandis Site',
                'slug' => 'kandis-site'
            ],
        ];

        foreach($projects as $project) {
            Project::create($project);
        }
    }
}
