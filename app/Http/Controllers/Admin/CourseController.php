<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('category');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $courses = $query->latest()->paginate(15);
        $categories = CourseCategory::orderBy('name')->get();

        return view('admin.courses.index', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = CourseCategory::orderBy('name')->get();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:course_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'mode' => ['nullable', 'string', 'max:255'],
            'eligibility' => ['nullable', 'string'],
            'fee' => ['nullable', 'string', 'max:255'],
            'certification' => ['boolean'],
            'placement_support' => ['boolean'],
            'technologies' => ['nullable', 'string'], // Will be cast to array if we format it, but let's keep it simple string for now, or json. User requested json, so we'll encode it if it's an array. If input is string, explode by comma.
            'featured' => ['boolean'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ]);

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        }

        $course = Course::create($validated);
        return redirect()->route('admin.courses.edit', $course)->with('success', 'Course created successfully. You can now add modules and FAQs.');
    }

    public function edit(Course $course)
    {
        $categories = CourseCategory::orderBy('name')->get();
        $course->load('modules', 'faqs');
        
        // Transform technologies back to string for the input
        if (is_array($course->technologies)) {
            $course->technologies_str = implode(', ', $course->technologies);
        } else {
            $course->technologies_str = '';
        }

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:course_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'full_description' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'mode' => ['nullable', 'string', 'max:255'],
            'eligibility' => ['nullable', 'string'],
            'fee' => ['nullable', 'string', 'max:255'],
            'certification' => ['boolean'],
            'placement_support' => ['boolean'],
            'technologies' => ['nullable', 'string'],
            'featured' => ['boolean'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ]);

        $validated['certification'] = $request->boolean('certification');
        $validated['placement_support'] = $request->boolean('placement_support');
        $validated['featured'] = $request->boolean('featured');

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_filter(array_map('trim', explode(',', $validated['technologies'])));
        } else {
            $validated['technologies'] = null;
        }

        $course->update($validated);
        return redirect()->route('admin.courses.edit', $course)->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
