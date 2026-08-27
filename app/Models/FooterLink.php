<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterLink extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'url', 'order_position', 'status'];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
