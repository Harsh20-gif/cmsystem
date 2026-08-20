<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function store(Request $request, GalleryAlbum $album)
    {
        $validated = $request->validate([
            'image_path' => ['required', 'string'],
            'caption' => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
        ]);

        $album->images()->create($validated);
        
        return redirect()->route('admin.gallery-albums.edit', $album)->with('success', 'Image added to album.');
    }

    public function update(Request $request, GalleryImage $image)
    {
        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
        ]);

        $image->update($validated);
        
        return redirect()->route('admin.gallery-albums.edit', $image->album_id)->with('success', 'Image updated successfully.');
    }

    public function destroy(GalleryImage $image)
    {
        $albumId = $image->album_id;
        $image->delete();
        
        return redirect()->route('admin.gallery-albums.edit', $albumId)->with('success', 'Image removed from album.');
    }
}
