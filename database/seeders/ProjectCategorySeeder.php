<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smart Fertigation System',
                'slug' => 'sfs'
            ],
            [
                'name' => 'smart cattle breeding System',
                'slug' => 'scbs'
            ],
        ];

        foreach($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
