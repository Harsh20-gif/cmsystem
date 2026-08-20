<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GalleryAlbumController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryAlbum::withCount('images');
        
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        
        $albums = $query->latest()->paginate(15);
        return view('admin.gallery_albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery_albums.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $album = GalleryAlbum::create($validated);
        return redirect()->route('admin.gallery-albums.edit', $album)->with('success', 'Album created successfully. You can now add images.');
    }

    public function edit(GalleryAlbum $galleryAlbum)
    {
        $galleryAlbum->load('images');
        return view('admin.gallery_albums.edit', compact('galleryAlbum'));
    }

    public function update(Request $request, GalleryAlbum $galleryAlbum)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $galleryAlbum->update($validated);
        return redirect()->route('admin.gallery-albums.edit', $galleryAlbum)->with('success', 'Album updated successfully.');
    }

    public function destroy(GalleryAlbum $galleryAlbum)
    {
        $galleryAlbum->delete();
        return redirect()->route('admin.gallery-albums.index')->with('success', 'Album deleted successfully.');
    }
}
