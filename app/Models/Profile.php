<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table ='profiles';
    protected $fillable=[
        'name', 'email', 'password', 'age', 'height', 'weight', 'goal'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
