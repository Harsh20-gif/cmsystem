<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ContentBlock;

class FrontendController extends Controller
{
    /**
     * Format courses for JS rendering (shared helper).
     */
    private function formatCourses($courses)
    {
        return $courses->map(function ($course) {
            $syllabus = $course->modules->pluck('title')->toArray();

            return [
                'id' => $course->slug,
                'category' => $course->category ? $course->category->slug : 'general',
                'tag' => $course->placement_support ? 'Job-Guaranteed' : 'Popular',
                'tagClass' => $course->placement_support ? 'job-guaranteed' : 'popular',
                'mode' => $course->mode ?? 'Online / Classroom',
                'title' => $course->title,
                'desc' => $course->short_description ?? '',
                'duration' => $course->duration ?? 'N/A',
                'projects' => 'Real-world Projects',
                'rating' => '5.0 (Reviews)',
                'tools' => $course->technologies ?? [],
                'fee' => $course->fee ?? 'Contact Us',
                'emi' => '',
                'image' => $course->thumbnail ? \Illuminate\Support\Facades\Storage::url($course->thumbnail) : asset('frontend/assets/logo_v1.png'),
                'syllabus' => count($syllabus) > 0 ? $syllabus : ['Syllabus details available soon.']
            ];
        });
    }

    public function index()
    {
        $companies = \App\Models\Company::all();
        $sliders = \App\Models\Slider::published()->orderBy('order_position')->get();
        $marqueeNotices = \App\Models\Notice::published()->where('type', 'marquee')->latest()->get();
        $boardNotices = \App\Models\Notice::published()->where('type', 'board')->latest()->get();
        $homePage = \App\Models\Page::where('page_key', 'home')->first();

        // Content blocks for home page
        $homeBlocks = ContentBlock::forPage('home');

        $courseCategories = \App\Models\CourseCategory::published()->orderBy('order_position')->get();
        $aboutHighlights = \App\Models\HomeAboutHighlight::published()->orderBy('order_position')->get();
        $trainingFeatures = \App\Models\HomeTrainingFeature::published()->orderBy('order_position')->get();

        $courses = Course::with(['category', 'modules'])->where('status', 'published')->get();
        $formattedCourses = $this->formatCourses($courses);

        return view('frontend.index', compact(
            'companies', 'sliders', 'marqueeNotices', 'boardNotices', 'homePage',
            'courseCategories', 'formattedCourses', 'aboutHighlights', 'trainingFeatures',
            'homeBlocks'
        ));
    }

    public function courses()
    {
        $courseCategories = \App\Models\CourseCategory::published()->orderBy('order_position')->get();
        $courses = Course::with(['category', 'modules'])->where('status', 'published')->get();
        $formattedCourses = $this->formatCourses($courses);

        return view('frontend.courses', compact('courseCategories', 'formattedCourses'));
    }

    public function csItCourses()
    {
        // Pull CS/IT category courses from the DB instead of hardcoding
        $courseCategories = \App\Models\CourseCategory::published()->orderBy('order_position')->get();
        $csItCategory = \App\Models\CourseCategory::where('slug', 'cs-it')->first();

        $courses = Course::with(['category', 'modules'])
            ->where('status', 'published')
            ->when($csItCategory, fn($q) => $q->where('category_id', $csItCategory->id))
            ->get();
        $formattedCourses = $this->formatCourses($courses);

        return view('frontend.cs-it-courses', compact('courseCategories', 'formattedCourses'));
    }

    public function coreEngineering()
    {
        $courseCategories = \App\Models\CourseCategory::published()->orderBy('order_position')->get();

        // Gather core engineering categories (non-CS/IT)
        $coreCategories = \App\Models\CourseCategory::published()
            ->where('slug', '!=', 'cs-it')
            ->pluck('id');

        $courses = Course::with(['category', 'modules'])
            ->where('status', 'published')
            ->whereIn('category_id', $coreCategories)
            ->get();
        $formattedCourses = $this->formatCourses($courses);

        // Group courses by category for sectioned display
        $coursesByCategory = $courses->groupBy(function ($course) {
            return $course->category ? $course->category->slug : 'general';
        });

        return view('frontend.core-engineering', compact('courseCategories', 'formattedCourses', 'coursesByCategory'));
    }

    public function about()
    {
        $page = \App\Models\Page::where('page_key', 'about')->first();
        $teamMembers = \App\Models\TeamMember::published()->orderBy('order_position')->get();
        $aboutFeatures = \App\Models\AboutFeature::published()->orderBy('order_position')->get();
        $aboutFacilityCards = \App\Models\AboutFacilityCard::published()->orderBy('order_position')->get();
        return view('frontend.about', compact('page', 'teamMembers', 'aboutFeatures', 'aboutFacilityCards'));
    }

    public function contact()
    {
        $page = \App\Models\Page::where('page_key', 'contact')->first();
        $states = config('states');
        $branches = \App\Models\EngineeringBranch::published()->orderBy('order_position')->get();
        return view('frontend.contact', compact('page', 'states', 'branches'));
    }

    public function corporateTraining()
    {
        $trainings = \App\Models\Training::published()->latest()->get();
        return view('frontend.corporate-training', compact('trainings'));
    }

    public function gallery()
    {
        $albums = \App\Models\GalleryAlbum::with('images')->published()->orderBy('event_date', 'desc')->get();
        return view('frontend.gallery', compact('albums'));
    }

    public function placements()
    {
        $placements = \App\Models\Placement::with(['student', 'company'])->published()->orderByDesc('placement_date')->get();
        $companies = \App\Models\Company::all();
        return view('frontend.placements', compact('placements', 'companies'));
    }

    public function submitEnquiry(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'type' => 'nullable|string'
        ]);

        \App\Models\Enquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'state' => $validated['location'],
            'city' => '',
            'college' => '',
            'message' => 'Interested in: ' . ($validated['course_name'] ?? 'General') . "\n\nMessage: " . ($validated['message'] ?? ''),
            'type' => $validated['type'] ?? 'registration',
            'status' => 'new'
        ]);

        return response()->json(['success' => true, 'message' => 'Registration Successful! Our career counselor will call you within 30 minutes.']);
    }
}
