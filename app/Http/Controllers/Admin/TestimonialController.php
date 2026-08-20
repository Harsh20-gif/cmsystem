<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('role_or_company', 'like', '%' . $request->q . '%');
        }
        
        $testimonials = $query->orderBy('order_position')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_or_company' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'photo' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_or_company' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'photo' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
