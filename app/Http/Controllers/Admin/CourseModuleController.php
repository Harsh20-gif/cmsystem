<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;

class CourseModuleController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_position' => ['required', 'integer'],
        ]);

        $course->modules()->create($validated);
        
        return redirect()->route('admin.courses.edit', $course)->with('success', 'Module added successfully.');
    }

    public function update(Request $request, CourseModule $module)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order_position' => ['required', 'integer'],
        ]);

        $module->update($validated);
        
        return redirect()->route('admin.courses.edit', $module->course_id)->with('success', 'Module updated successfully.');
    }

    public function destroy(CourseModule $module)
    {
        $courseId = $module->course_id;
        $module->delete();
        
        return redirect()->route('admin.courses.edit', $courseId)->with('success', 'Module deleted successfully.');
    }
}
