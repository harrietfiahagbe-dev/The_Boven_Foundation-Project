<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_headline', 'value' => 'Empowering Communities Through Education and Action'],
            ['key' => 'hero_subtext', 'value' => 'Closing the education gap with STEM resources, mentorship, and inclusive learning spaces for underserved youth.'],
            ['key' => 'tagline', 'value' => 'Igniting Minds, Transforming Communities'],
            ['key' => 'about_paragraph', 'value' => "The Boven's Foundation is a nonprofit organization dedicated to closing the education gap in communities across Ghana where access to quality STEM education is limited. We believe every child deserves the tools and opportunities to excel in science, technology, engineering, and mathematics, regardless of their background or gender.\n\nStarting in Elmina and expanding to other communities facing educational gaps, we provide hands-on learning experiences, mentorship programs, and resources that transform how young people engage with STEM. Through our work, we are not just teaching, we are empowering the next generation of innovators, problem-solvers, and leaders.\n\nOur approach is rooted in collaboration. We work closely with local schools, teachers, parents, and community leaders to ensure our programs meet real needs and create lasting change. From organizing workshops that inspire both boys and girls to improving school facilities, we're committed to making STEM education accessible, inclusive, and impactful. As we grow, we envision building dedicated STEM labs where students can explore, experiment, and discover their potential.\n\nAt The Boven's Foundation, we don't just dream of a more equitable future, we're building it, one student, one school, one community at a time."],
            ['key' => 'mission_statement', 'value' => 'To close the education gap by providing underserved youth with STEM resources, mentorship, and inclusive learning spaces that unlock their potential.'],
            ['key' => 'vision_statement', 'value' => 'To create a future where every child, regardless of gender or background, has equal access to quality STEM education, empowering them to become problem-solvers, innovators, and leaders in their communities.'],
            ['key' => 'values_json', 'value' => json_encode([
                ['title' => 'Innovation', 'description' => 'We embrace creative solutions to solve educational challenges.'],
                ['title' => 'Integrity', 'description' => 'We operate with honesty and transparency in all we do.'],
                ['title' => 'Empowerment', 'description' => 'We equip young people to become problem-solvers and leaders.'],
                ['title' => 'Community', 'description' => 'We work with communities, not just for them.'],
                ['title' => 'Inclusivity', 'description' => 'Every child deserves a fair chance. We prioritize access for those left behind, regardless of gender or background.'],
            ])],
            ['key' => 'ngo_email', 'value' => 'thebovenfoundation@gmail.com'],
            ['key' => 'ngo_address', 'value' => 'Elmina, Cape Coast, Ghana.'],
            ['key' => 'stat_communities', 'value' => '3'],
            ['key' => 'stat_partners', 'value' => '0'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
