<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use App\Models\Student;
use App\Models\Company;
use Illuminate\Http\Request;

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
        ]);

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
        ]);

        $placement->update($validated);
        return redirect()->route('admin.placements.index')->with('success', 'Placement updated successfully.');
    }

    public function destroy(Placement $placement)
    {
        $placement->delete();
        return redirect()->route('admin.placements.index')->with('success', 'Placement deleted successfully.');
    }
}
