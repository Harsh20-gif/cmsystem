<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentBlock;

class ContentBlockSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // HOME PAGE — Gateway Cards (Learning Hub section)
        // =====================================================================
        $gatewayCards = [
            [
                'title' => 'CS & IT Programs',
                'description' => 'Fullstack Web Development, Data Science & AI, Cloud Computing DevOps, and Cyber Security with live projects.',
                'icon_class' => 'fas fa-laptop-code',
                'color_class' => 'orange',
                'link' => '/cs-it-courses',
                'link_label' => 'Explore CS/IT Track',
            ],
            [
                'title' => 'Core Engineering Tracks',
                'description' => 'PLC SCADA Automation, MEP & HVAC Design, Embedded Systems & IoT, and Civil AutoCad / Revit software.',
                'icon_class' => 'fas fa-cogs',
                'color_class' => 'navy',
                'link' => '/core-engineering',
                'link_label' => 'Explore Core Tracks',
            ],
            [
                'title' => 'Summer / Winter Trainings',
                'description' => '4 to 8-Week BTech industrial internship programs with ISO project completion certificates & college MOU support.',
                'icon_class' => 'fas fa-university',
                'color_class' => 'green',
                'link' => '/corporate-training',
                'link_label' => 'Explore Internships',
            ],
            [
                'title' => 'Placement Wall & Alumni',
                'description' => 'View placed BTech candidates, corporate hiring records, package distribution, and interview success stories.',
                'icon_class' => 'fas fa-trophy',
                'color_class' => 'orange',
                'link' => '/placements',
                'link_label' => 'View Placement Wall',
            ],
        ];

        foreach ($gatewayCards as $i => $card) {
            ContentBlock::firstOrCreate(
                ['page_key' => 'home', 'block_type' => 'gateway_cards', 'title' => $card['title']],
                array_merge($card, ['order_position' => $i, 'status' => 'published'])
            );
        }

        // =====================================================================
        // HOME PAGE — Why Choose Us Cards
        // =====================================================================
        $whyChooseUs = [
            [
                'title' => '100% Placement Focus',
                'description' => 'Dedicated placement cell conducting mock technical interviews, resume crafting, LinkedIn optimization, and hiring drives with 350+ corporate partners.',
                'icon_class' => 'fas fa-handshake',
                'color_class' => 'orange',
            ],
            [
                'title' => 'Project-Based Learning',
                'description' => 'Build enterprise-grade applications, handle industrial PLC SCADA setups, deploy cloud apps, and complete live client projects.',
                'icon_class' => 'fas fa-laptop-code',
                'color_class' => 'navy',
            ],
            [
                'title' => 'Industry Expert Mentors',
                'description' => 'Learn directly from Senior Architects, Tech Leads, and Engineering Managers with 10+ years experience in MNCs and tech startups.',
                'icon_class' => 'fas fa-user-tie',
                'color_class' => 'green',
            ],
            [
                'title' => 'ISO & Quality Certified',
                'description' => 'Receive globally valid ISO 9001:2015 certifications recognized across MNCs, government skilling initiatives, and higher education.',
                'icon_class' => 'fas fa-award',
                'color_class' => 'green',
            ],
            [
                'title' => '1-on-1 Doubt Support',
                'description' => 'Daily dedicated mentor support hours so you never get stuck on any code error, hardware bug, or conceptual doubt.',
                'icon_class' => 'fas fa-headset',
                'color_class' => 'orange',
            ],
            [
                'title' => 'Multi-Center Infrastructure',
                'description' => 'State-of-the-art computer labs and core engineering hardware stations in Noida, Lucknow, and Bhopal.',
                'icon_class' => 'fas fa-city',
                'color_class' => 'navy',
            ],
        ];

        foreach ($whyChooseUs as $i => $card) {
            ContentBlock::firstOrCreate(
                ['page_key' => 'home', 'block_type' => 'why_choose_us', 'title' => $card['title']],
                array_merge($card, ['order_position' => $i, 'status' => 'published'])
            );
        }

        $this->command->info('Seeded content blocks: ' . count($gatewayCards) . ' gateway cards, ' . count($whyChooseUs) . ' why-choose-us cards.');
    }
}
