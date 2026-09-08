<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('category', 'public_assets');
        }

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
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        if ($request->hasFile('icon')) {
            if ($courseCategory->icon) {
                Storage::disk('public_assets')->delete($courseCategory->icon);
            }
            $validated['icon'] = $request->file('icon')->store('category', 'public_assets');
        }

        $courseCategory->update($validated);
        return redirect()->route('admin.course-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        if ($courseCategory->courses()->exists()) {
            return redirect()->route('admin.course-categories.index')->with('error', 'Cannot delete this category because it has active courses assigned to it. Please reassign or delete the courses first.');
        }

        if ($courseCategory->icon) {
            Storage::disk('public_assets')->delete($courseCategory->icon);
        }

        $courseCategory->delete();
        return redirect()->route('admin.course-categories.index')->with('success', 'Category deleted successfully.');
    }
}
