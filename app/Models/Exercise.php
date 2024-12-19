<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
        'category_id'
    ];

    public function workoutSessions()
    {
        return $this->hasMany(WorkoutSession::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
