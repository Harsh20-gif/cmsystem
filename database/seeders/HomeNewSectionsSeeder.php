<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeNewSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'home_about_title' => 'About Skill Bridge India Technologies',
            'home_about_text' => 'Skill Bridge India Technologies is a premier job-oriented BTech training and industrial placement institute delivering job-guaranteed skill transformation.',
            'home_about_btn_text' => 'Read More',
            'home_about_btn_link' => '/about',
            
            'home_training_title' => 'Hands-on Training with 100% Placement Assistance',
            'home_training_text' => 'Our training programs are designed to bridge the gap between academic knowledge and industry requirements.',
            'home_training_btn_text' => 'Explore Courses',
            'home_training_btn_link' => '/courses',
            
            'home_mission_title' => 'Our Mission',
            'home_mission_text' => 'To empower students with practical skills and industry exposure, ensuring they are career-ready and capable of thriving in the competitive corporate world.',
            
            'home_vision_title' => 'Our Vision',
            'home_vision_text' => 'To become the leading bridge between academic learning and industry demands, fostering a generation of highly skilled and employable engineering professionals.',
        ];

        foreach ($settings as $key => $value) {
            \App\Models\SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        \App\Models\HomeAboutHighlight::truncate();
        $highlights = [
            ['title' => 'Industry-Aligned Curriculum', 'icon_class' => 'fas fa-check-circle', 'order_position' => 1],
            ['title' => 'Experienced Mentors', 'icon_class' => 'fas fa-check-circle', 'order_position' => 2],
            ['title' => 'Practical & Hands-on Learning', 'icon_class' => 'fas fa-check-circle', 'order_position' => 3],
        ];
        foreach ($highlights as $h) {
            \App\Models\HomeAboutHighlight::create($h);
        }

        \App\Models\HomeTrainingFeature::truncate();
        $features = [
            [
                'title' => 'Live Industrial Projects', 
                'description' => 'Work on real-world projects simulating actual corporate environments.', 
                'icon_class' => 'fas fa-laptop-code', 
                'order_position' => 1
            ],
            [
                'title' => 'Expert Mentorship', 
                'description' => 'Learn directly from seasoned industry professionals.', 
                'icon_class' => 'fas fa-user-tie', 
                'order_position' => 2
            ],
            [
                'title' => 'Placement Support', 
                'description' => 'Dedicated placement drives and interview preparation.', 
                'icon_class' => 'fas fa-briefcase', 
                'order_position' => 3
            ],
            [
                'title' => 'Practical Labs', 
                'description' => 'Hands-on access to the latest tools and technologies.', 
                'icon_class' => 'fas fa-microscope', 
                'order_position' => 4
            ],
        ];
        foreach ($features as $f) {
            \App\Models\HomeTrainingFeature::create($f);
        }
    }
}
