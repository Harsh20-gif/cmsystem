<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'technologies' => 'array',
        'certification' => 'boolean',
        'placement_support' => 'boolean',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('order_position');
    }

    public function faqs()
    {
        return $this->hasMany(CourseFaq::class)->orderBy('order_position');
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
