<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use App\Models\Student;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlacementController extends Controller
{
    public function index(Request $request)
    {
        $query = Placement::with(['student', 'company']);
        
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }
        
        $placements = $query->latest('placement_date')->paginate(15);
        
        $students = Student::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        
        return view('admin.placements.index', compact('placements', 'students', 'companies'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        return view('admin.placements.create', compact('students', 'companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'position' => ['required', 'string', 'max:255'],
            'package' => ['nullable', 'string', 'max:255'],
            'placement_date' => ['nullable', 'date'],
            'testimonial_text' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('placements', 'public');
        }
        unset($validated['image']);
        
        $validated['job_role'] = $validated['position'];
        $validated['published'] = true;

        Placement::create($validated);
        return redirect()->route('admin.placements.index')->with('success', 'Placement created successfully.');
    }

    public function edit(Placement $placement)
    {
        $students = Student::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        return view('admin.placements.edit', compact('placement', 'students', 'companies'));
    }

    public function update(Request $request, Placement $placement)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'position' => ['required', 'string', 'max:255'],
            'package' => ['nullable', 'string', 'max:255'],
            'placement_date' => ['nullable', 'date'],
            'testimonial_text' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($placement->image_path) {
                Storage::disk('public')->delete($placement->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('placements', 'public');
        }
        unset($validated['image']);
        
        $validated['job_role'] = $validated['position'];
        $validated['published'] = true;

        $placement->update($validated);
        return redirect()->route('admin.placements.index')->with('success', 'Placement updated successfully.');
    }

    public function destroy(Placement $placement)
    {
        if ($placement->image_path) {
            Storage::disk('public')->delete($placement->image_path);
        }
        $placement->delete();
        return redirect()->route('admin.placements.index')->with('success', 'Placement deleted successfully.');
    }
}
