<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ===== HEADER =====
            'header_phone' => '+91 8467912807',
            'header_email' => 'info@skillbridgeindiatechnology.com',
            'header_logo' => '',  // empty = use default asset
            'header_cta_label' => 'Enquire Now',
            'header_cta_modal_title' => 'Free Demo Class',

            // Nav labels
            'nav_home' => 'Home',
            'nav_about' => 'About Us',
            'nav_courses' => 'Courses',
            'nav_trainings' => 'Trainings',
            'nav_placements' => 'Placements',
            'nav_gallery' => 'Gallery',
            'nav_contact' => 'Contact Us',
            'nav_explore_all_courses' => 'Explore All Courses',

            // ===== FOOTER (section titles) =====
            'footer_quick_links_title' => 'Quick Links',
            'footer_contact_title' => 'Contact Us',

            // ===== HOME PAGE =====
            'home_page_title' => 'Skill Bridge India Technologies | BTech Training & Placement',
            'home_marquee_label' => 'Updates:',
            'home_hero_badge' => 'Future-Ready Engineering Skilling',
            'home_hero_feature1' => '100% Placement Assistance',
            'home_hero_feature2' => 'Live Industrial Projects',
            'home_hero_cta_explore_label' => 'Explore Now',
            'home_hero_cta_counseling_label' => 'Start Free Counseling',

            // About section on home
            'home_about_badge' => 'Discover Who We Are',

            // Training section on home
            'home_training_badge' => 'Accelerate Your Career',

            // Learning Hub section
            'home_hub_badge' => 'Explore Learning Tracks',
            'home_hub_title' => 'Specialized Training Centers',
            'home_hub_subtitle' => 'Discover our branch-specific training departments, industrial internship programs, and placement records.',

            // Courses section on home
            'home_courses_badge' => 'Top Featured Courses',
            'home_courses_title' => 'Job-Oriented Programs',
            'home_courses_subtitle' => 'Top rated BTech skilling tracks with live hands-on practical labs and 100% placement support.',
            'home_courses_filter_all' => 'All Programs',
            'home_courses_catalog_label' => 'View Full Course Catalog',

            // Why Choose Us section
            'home_whychoose_badge' => 'Best-In-Class Training Ecosystem',
            'home_whychoose_title' => 'Why Choose Skill Bridge India',
            'home_whychoose_subtitle' => 'Practical learning, expert faculty, live industrial labs, and placement support in one single platform.',

            // Partners section on home
            'home_partners_badge' => 'Our Alumni Work Here',
            'home_partners_title' => '350+ Top Corporate Hiring Partners',
            'home_partners_subtitle' => 'Our students work at leading Fortune 500 tech companies, MNCs, and fast-growing unicorns.',
            'home_partners_btn_label' => 'Explore Placement Wall & Alumni Stories',

            // Notices section
            'home_notices_title' => 'Important Notices',

            // Gallery CTA banner on home
            'home_gallery_cta_badge' => 'Campus & Labs Life',
            'home_gallery_cta_title' => 'Want to See Our Labs & Campus Drive Photos?',
            'home_gallery_cta_subtitle' => 'Browse live photos of CS/IT practical labs, industrial automation hardware setups, and university campus seminars.',
            'home_gallery_cta_btn_label' => 'Open Photo Gallery Page',

            // ===== ABOUT PAGE =====
            'about_section_what_we_do' => 'What We Do',
            'about_section_why_skill_bridge' => 'Why Skill Bridge',
            'about_section_our_values' => 'Our Values',

            // ===== COURSES PAGE =====
            'courses_page_title' => 'All Courses Catalog | Skill Bridge India Technologies',

            // ===== CS/IT PAGE =====
            'csit_page_title' => 'Computer Science & IT Courses | Skill Bridge India Technologies',

            // ===== CORE ENGINEERING PAGE =====
            'core_page_title' => 'Core Engineering Training | Skill Bridge India Technologies',

            // ===== TRAININGS PAGE =====
            'trainings_page_title' => 'Corporate Training & Summer Internships | Skill Bridge India',
            'trainings_section_subtitle' => 'Select your branch specialization for 4-Week, 6-Week, or 6-Month industrial internship modules.',

            // ===== PLACEMENTS PAGE =====
            'placements_page_title' => 'Alumni Placement Wall | Skill Bridge India Technologies',
            'placements_placed_at_label' => 'Placed at:',

            // ===== GALLERY PAGE =====
            'gallery_page_title' => 'Photo Gallery & Events | Skill Bridge India',

            // ===== CONTACT PAGE =====
            'contact_badge_form' => 'Direct Inquiry',
            'contact_form_title' => 'Send Us a Message',
            'contact_badge_hours' => 'Working Hours & Support',
            'contact_desk_title' => 'Counseling Desk',
            'contact_form_submit_label' => 'Submit Inquiry',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::firstOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        $this->command->info('Seeded ' . count($settings) . ' site settings (firstOrCreate — existing values preserved).');
    }
}
