<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionPlan extends Model
{
    protected $fillable = [
        'user_id', 'calories', 'protein', 'carbs', 'fats', 'notes'
    ];


    public function user()
    {
        return $this->belongsTo(User::class); // كل خطة غذائية تنتمي إلى مستخدم واحد
    }
}
