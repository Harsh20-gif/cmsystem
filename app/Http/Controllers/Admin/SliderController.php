<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $query = Slider::query();
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        
        $sliders = $query->orderBy('order_position')->paginate(15);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'link' => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $data = $validated;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public_assets');
        }

        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'link' => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $data = $validated;
        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public_assets')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public_assets');
        } else {
            unset($data['image']);
        }

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public_assets')->delete($slider->image);
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
