<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order_position');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->page_key)) {
                $model->page_key = \Illuminate\Support\Str::slug($model->title);
                $count = static::whereRaw("page_key RLIKE '^{$model->page_key}(-[0-9]+)?$'")->count();
                $model->page_key = $count ? "{$model->page_key}-{$count}" : $model->page_key;
            }
        });
    }
}
