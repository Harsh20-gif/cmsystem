<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseFaq;
use App\Models\Training;
use App\Models\Company;
use App\Models\Student;
use App\Models\Placement;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        // Course Categories
        $cat1 = CourseCategory::create(['name' => 'Web Development', 'status' => 'published']);
        $cat2 = CourseCategory::create(['name' => 'Data Science', 'status' => 'published']);
        $cat3 = CourseCategory::create(['name' => 'Digital Marketing', 'status' => 'published']);

        // Courses
        $courses = [
            ['title' => 'Full Stack Laravel & Vue', 'category_id' => $cat1->id, 'duration' => '6 Months', 'fee' => '₹45,000', 'status' => 'published'],
            ['title' => 'MERN Stack Bootcamp', 'category_id' => $cat1->id, 'duration' => '5 Months', 'fee' => '₹40,000', 'status' => 'published'],
            ['title' => 'Data Science with Python', 'category_id' => $cat2->id, 'duration' => '6 Months', 'fee' => '₹50,000', 'status' => 'published'],
            ['title' => 'Machine Learning A-Z', 'category_id' => $cat2->id, 'duration' => '4 Months', 'fee' => '₹35,000', 'status' => 'published'],
            ['title' => 'Advanced SEO & SEM', 'category_id' => $cat3->id, 'duration' => '3 Months', 'fee' => '₹25,000', 'status' => 'published'],
            ['title' => 'Social Media Marketing', 'category_id' => $cat3->id, 'duration' => '2 Months', 'fee' => '₹20,000', 'status' => 'published'],
        ];

        $createdCourses = [];
        foreach ($courses as $c) {
            $course = Course::create(array_merge($c, [
                'short_description' => 'Learn ' . $c['title'] . ' from scratch.',
                'full_description' => 'Detailed syllabus and hands-on projects for ' . $c['title'],
                'mode' => 'Hybrid',
                'eligibility' => 'Any Graduate',
                'certification' => true,
                'placement_support' => true,
            ]));
            $createdCourses[] = $course;

            // Modules
            CourseModule::create(['course_id' => $course->id, 'title' => 'Introduction', 'description' => 'Getting started with basics.', 'order_position' => 1]);
            CourseModule::create(['course_id' => $course->id, 'title' => 'Advanced Concepts', 'description' => 'Deep dive into the subject.', 'order_position' => 2]);

            // FAQs
            CourseFaq::create(['course_id' => $course->id, 'question' => 'Is there placement support?', 'answer' => 'Yes, 100% placement assistance is provided.']);
            CourseFaq::create(['course_id' => $course->id, 'question' => 'Do I get a certificate?', 'answer' => 'Yes, an industry-recognized certificate is awarded upon completion.']);
        }

        // Trainings
        Training::create([
            'course_id' => $createdCourses[0]->id,
            'title' => 'Summer Internship 2026',
            'type' => 'summer',
            'start_date' => '2026-06-01',
            'end_date' => '2026-07-15',
            'duration' => '45 Days',
            'location' => 'Main Campus',
            'mode' => 'Offline',
            'status' => 'published',
        ]);
        Training::create([
            'title' => 'Corporate Workshop on AI',
            'type' => 'workshop',
            'duration' => '2 Days',
            'location' => 'Tech Hub',
            'mode' => 'Offline',
            'status' => 'published',
        ]);

        // Companies
        $comp1 = Company::create(['name' => 'TechCorp', 'website' => 'https://techcorp.example.com']);
        $comp2 = Company::create(['name' => 'InnoSoft', 'website' => 'https://innosoft.example.com']);

        // Students
        $stu1 = Student::create(['name' => 'Rahul Sharma', 'course_id' => $createdCourses[0]->id]);
        $stu2 = Student::create(['name' => 'Priya Singh', 'course_id' => $createdCourses[2]->id]);

        // Placements
        Placement::create(['student_id' => $stu1->id, 'company_id' => $comp1->id, 'job_role' => 'Software Engineer', 'package' => '8 LPA', 'batch' => '2025', 'published' => true]);
        Placement::create(['student_id' => $stu2->id, 'company_id' => $comp2->id, 'job_role' => 'Data Analyst', 'package' => '6 LPA', 'batch' => '2025', 'published' => true]);

        // Gallery
        $album = GalleryAlbum::create(['title' => 'Annual Convocation 2025', 'category' => 'Events', 'status' => 'published']);
        GalleryImage::create(['album_id' => $album->id, 'image_path' => 'demo/convocation1.jpg', 'caption' => 'Award Ceremony']);
        GalleryImage::create(['album_id' => $album->id, 'image_path' => 'demo/convocation2.jpg', 'caption' => 'Group Photo']);

        // Team Members
        TeamMember::create(['name' => 'Amit Patel', 'designation' => 'Founder & CEO', 'status' => 'published']);
        TeamMember::create(['name' => 'Neha Gupta', 'designation' => 'Lead Instructor', 'status' => 'published']);

        // Testimonials
        Testimonial::create(['name' => 'Sunil Kumar', 'course_id' => $createdCourses[0]->id, 'message' => 'Excellent teaching methodology and great placement support.', 'rating' => 5, 'status' => 'published']);

        // Branches
        Branch::create(['name' => 'Head Office', 'address' => '123 Education Street, Tech City', 'phone' => '+91-9876543210', 'email' => 'info@eduskill.test', 'status' => 'published']);

        // Enquiries
        Enquiry::create(['name' => 'Vikram', 'email' => 'vikram@example.com', 'phone' => '9988776655', 'course_id' => $createdCourses[1]->id, 'message' => 'Need details about MERN stack.', 'status' => 'new']);

        // Pages
        $about = Page::create(['page_key' => 'about', 'title' => 'About Us']);
        PageSection::create(['page_id' => $about->id, 'section_key' => 'intro', 'heading' => 'Who We Are', 'content' => 'EduSkill is a premier training institute.']);
        
        $contact = Page::create(['page_key' => 'contact', 'title' => 'Contact Us']);

        // Site Settings
        $settings = [
            'students_trained' => '10000+',
            'courses_count' => '50+',
            'hiring_partners_count' => '200+',
            'satisfaction_rate' => '98%',
            'phone' => '+91-9876543210',
            'email' => 'info@eduskill.test',
            'address' => '123 Education Street, Tech City',
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_linkedin' => 'https://linkedin.com',
            'social_youtube' => 'https://youtube.com',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::create(['setting_key' => $key, 'setting_value' => $val]);
        }
    }
}
