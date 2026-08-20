<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $query = Branch::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('city', 'like', '%' . $request->q . '%');
        }
        
        $branches = $query->orderBy('order_position')->paginate(15);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'map_embed_code' => ['nullable', 'string'],
            'is_head_office' => ['boolean'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $validated['is_head_office'] = $request->boolean('is_head_office');

        if ($validated['is_head_office']) {
            Branch::where('id', '!=', 0)->update(['is_head_office' => false]);
        }

        Branch::create($validated);
        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'map_embed_code' => ['nullable', 'string'],
            'is_head_office' => ['boolean'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $validated['is_head_office'] = $request->boolean('is_head_office');

        if ($validated['is_head_office']) {
            Branch::where('id', '!=', $branch->id)->update(['is_head_office' => false]);
        }

        $branch->update($validated);
        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }
}
