<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function placements()
    {
        return $this->hasMany(Placement::class);
    }
}
