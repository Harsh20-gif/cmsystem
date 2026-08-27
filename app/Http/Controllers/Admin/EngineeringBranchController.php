<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EngineeringBranch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EngineeringBranchController extends Controller
{
    public function index(Request $request)
    {
        $query = EngineeringBranch::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $branches = $query->orderBy('order_position')->paginate(15);
        return view('admin.engineering_branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.engineering_branches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        EngineeringBranch::create($validated);
        return redirect()->route('admin.engineering-branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit(EngineeringBranch $engineeringBranch)
    {
        return view('admin.engineering_branches.edit', compact('engineeringBranch'));
    }

    public function update(Request $request, EngineeringBranch $engineeringBranch)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $engineeringBranch->update($validated);
        return redirect()->route('admin.engineering-branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(EngineeringBranch $engineeringBranch)
    {
        $engineeringBranch->delete();
        return redirect()->route('admin.engineering-branches.index')->with('success', 'Branch deleted successfully.');
    }
}
