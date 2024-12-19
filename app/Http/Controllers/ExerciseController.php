<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        //eger-loading
        $exercises = Exercise::with('category')->get(); // استرجاع التمارين مع التصنيفات
        return response()->json($exercises);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:exercises',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $exercise = Exercise::create($data);
        return response()->json($exercise, 201);
    }

    public function show(Exercise $exercise)
    {
        //lazy loading
        $exercise->load('category'); // تحميل التصنيف المرتبط
        return response()->json($exercise);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:exercises,name,' . $exercise->id,
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $exercise->update($data);
        return response()->json($exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return response()->json(['message' => 'Exercise deleted successfully']);
    }
}
