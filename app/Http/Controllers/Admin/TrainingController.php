<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query = Training::with('course');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $trainings = $query->latest()->paginate(15);
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.trainings.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['nullable', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['summer', 'winter', 'industrial', 'internship', 'corporate', 'workshop'])],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'duration' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'mode' => ['nullable', 'string', 'max:255'],
            'trainer' => ['nullable', 'string', 'max:255'],
            'seats' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'registration_status' => ['required', Rule::in(['open', 'closed'])],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        Training::create($validated);
        return redirect()->route('admin.trainings.index')->with('success', 'Training created successfully.');
    }

    public function edit(Training $training)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.trainings.edit', compact('training', 'courses'));
    }

    public function update(Request $request, Training $training)
    {
        $validated = $request->validate([
            'course_id' => ['nullable', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['summer', 'winter', 'industrial', 'internship', 'corporate', 'workshop'])],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'duration' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'mode' => ['nullable', 'string', 'max:255'],
            'trainer' => ['nullable', 'string', 'max:255'],
            'seats' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'registration_status' => ['required', Rule::in(['open', 'closed'])],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        $training->update($validated);
        return redirect()->route('admin.trainings.index')->with('success', 'Training updated successfully.');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('admin.trainings.index')->with('success', 'Training deleted successfully.');
    }
}
