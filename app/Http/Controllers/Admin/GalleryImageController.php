<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    public function store(Request $request, GalleryAlbum $galleryAlbum)
    {
        $validated = $request->validate([
            'image_path' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'caption' => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
        ]);

        $validated['image_path'] = $request->file('image_path')->store('group', 'public_assets');

        $galleryAlbum->images()->create($validated);
        
        return redirect()->route('admin.gallery-albums.edit', $galleryAlbum)->with('success', 'Image added to album.');
    }

    public function storeFromMedia(Request $request, GalleryAlbum $galleryAlbum)
    {
        $validated = $request->validate([
            'media_path'     => ['required', 'string', 'max:500'],
            'caption'        => ['nullable', 'string', 'max:255'],
            'order_position' => ['required', 'integer'],
        ]);

        $galleryAlbum->images()->create([
            'image_path'     => $validated['media_path'],
            'caption'        => $validated['caption'] ?? null,
            'order_position' => $validated['order_position'],
        ]);

        return redirect()->route('admin.gallery-albums.edit', $galleryAlbum)->with('success', 'Image added to album from media library.');
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
        
        if ($image->image_path) {
            Storage::disk('public_assets')->delete($image->image_path);
        }
        
        $image->delete();
        
        return redirect()->route('admin.gallery-albums.edit', $albumId)->with('success', 'Image removed from album.');
    }
}
