<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::latest()->paginate(24);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.media.partials.grid', compact('media'))->render(),
                'next_page' => $media->nextPageUrl()
            ]);
        }

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'max:5120'], // 5MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');

        $media = Media::create([
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        if ($request->ajax()) {
            return response()->json($media);
        }

        return back()->with('success', 'Media uploaded successfully.');
    }

    public function destroy(Media $medium)
    {
        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();
        
        return back()->with('success', 'Media deleted successfully.');
    }
}
