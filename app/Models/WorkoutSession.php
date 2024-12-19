<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model
{
    protected $fillable = [
        'user_id', 'exercise_id', 'date', 'duration', 'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
