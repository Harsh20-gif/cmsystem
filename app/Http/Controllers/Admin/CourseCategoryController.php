<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = CourseCategory::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $categories = $query->orderBy('order_position')->paginate(15);
        return view('admin.course_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.course_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        CourseCategory::create($validated);
        return redirect()->route('admin.course-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.course_categories.edit', compact('courseCategory'));
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $courseCategory->update($validated);
        return redirect()->route('admin.course-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        if ($courseCategory->courses()->exists()) {
            return redirect()->route('admin.course-categories.index')->with('error', 'Cannot delete this category because it has active courses assigned to it. Please reassign or delete the courses first.');
        }

        $courseCategory->delete();
        return redirect()->route('admin.course-categories.index')->with('success', 'Category deleted successfully.');
    }
}
