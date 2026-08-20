<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'event_date' => 'date',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'album_id')->orderBy('order_position');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
                $count = static::whereRaw("slug RLIKE '^{$model->slug}(-[0-9]+)?$'")->count();
                $model->slug = $count ? "{$model->slug}-{$count}" : $model->slug;
            }
        });
    }
}
