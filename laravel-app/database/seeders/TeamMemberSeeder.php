<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Senam Boven Fiahagbe',
                'title' => 'Co-Founder',
                'bio' => 'Senam drives the vision and strategy of The Boven Foundation. She is committed to creating equal access to quality STEM education for every child.',
                'photo' => '/assets/img/picture8.jpeg',
                'linkedin_url' => null,
                'display_order' => 1,
            ],
            [
                'name' => 'Elorm Boven Fiahagbe',
                'title' => 'CFO',
                'bio' => 'Elorm oversees the financial health and sustainability of the foundation, ensuring resources are used effectively to maximize impact in communities.',
                'photo' => '/assets/img/picture9.jpeg',
                'linkedin_url' => null,
                'display_order' => 2,
            ],
            [
                'name' => 'Harriet Yayra Boven Fiahagbe',
                'title' => 'CMO',
                'bio' => 'Harriet leads communications and outreach, connecting the foundation with partners, donors, and communities to amplify our mission.',
                'photo' => '/assets/img/picture7.jpeg',
                'linkedin_url' => null,
                'display_order' => 3,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}
