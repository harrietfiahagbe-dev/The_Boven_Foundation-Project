<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'STEM Workshops in Elmina',
                'description' => 'Hands-on STEM workshops for primary and JHS students in Elmina, introducing coding, basic engineering, and science experiments. Reached over 200 students across 3 schools.',
                'image' => null,
                'status' => 'completed',
                'year' => 2024,
                'beneficiaries' => 200,
                'location' => 'Elmina, Cape Coast, Ghana',
            ],
            [
                'title' => 'Girls in STEM Initiative',
                'description' => 'A program designed to encourage and support girls in science and technology. Includes mentorship, role models, and safe learning spaces.',
                'image' => null,
                'status' => 'ongoing',
                'year' => 2024,
                'beneficiaries' => 80,
                'location' => 'Elmina and surrounding communities',
            ],
            [
                'title' => 'School Lab Support',
                'description' => 'Providing materials and training to local schools to run practical science and math lessons. Working with teachers and community leaders for sustainable impact.',
                'image' => null,
                'status' => 'ongoing',
                'year' => 2025,
                'beneficiaries' => null,
                'location' => 'Cape Coast, Ghana',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
