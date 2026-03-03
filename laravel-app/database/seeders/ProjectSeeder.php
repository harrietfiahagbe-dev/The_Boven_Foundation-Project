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
                'title' => 'Classroom Learning Support',
                'description' => 'Providing desks, learning materials, and supportive classroom environments so children can focus, participate, and thrive in their lessons.',
                'image' => null,
                'status' => 'ongoing',
                'year' => 2025,
                'beneficiaries' => null,
                'location' => 'Cape Coast, Ghana',
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title'], 'year' => $project['year']],
                $project
            );
        }
    }
}
