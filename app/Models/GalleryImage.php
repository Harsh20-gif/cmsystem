<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'album_id');
    }
}
