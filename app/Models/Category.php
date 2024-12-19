<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];
    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
