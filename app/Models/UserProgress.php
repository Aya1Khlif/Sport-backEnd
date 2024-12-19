<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id', 'date', 'weight', 'body_fat_percentage', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
