<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\NutritionPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use App\Http\Controllers\WorkoutSessionController;
use App\Models\NutritionPlan;
use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/users', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// روابط الإدارات المختلفة
Route::apiResource('user',UserController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('exercises', ExerciseController::class);
Route::apiResource('nutrition-plans', NutritionPlanController::class);
Route::apiResource('user-progress', UserProgressController::class);
Route::apiResource('workout-sessions', WorkoutSessionController::class);
Route::apiResource('profile', ProfileController::class);

