<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseFaq;
use Illuminate\Http\Request;

class CourseFaqController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order_position' => ['required', 'integer'],
        ]);

        $course->faqs()->create($validated);
        
        return redirect()->route('admin.courses.edit', $course)->with('success', 'FAQ added successfully.');
    }

    public function update(Request $request, CourseFaq $faq)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order_position' => ['required', 'integer'],
        ]);

        $faq->update($validated);
        
        return redirect()->route('admin.courses.edit', $faq->course_id)->with('success', 'FAQ updated successfully.');
    }

    public function destroy(CourseFaq $faq)
    {
        $courseId = $faq->course_id;
        $faq->delete();
        
        return redirect()->route('admin.courses.edit', $courseId)->with('success', 'FAQ deleted successfully.');
    }
}
