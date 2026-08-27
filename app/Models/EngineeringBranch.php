<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngineeringBranch extends Model
{
    protected $fillable = [
        'name',
        'order_position',
        'status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
