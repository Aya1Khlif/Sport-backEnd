<?php

namespace App\Http\Controllers;

use App\Models\NutritionPlan;
use Illuminate\Http\Request;

class NutritionPlanController extends Controller
{
    // عرض جميع خطط التغذية
    public function index()
    {
        $plans = NutritionPlan::with('user')->get(); // تحميل المستخدم المرتبط بالخطة
        return response()->json($plans);
    }

    // إنشاء خطة غذائية جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id', // تحقق من وجود المستخدم
            'calories' => 'required|integer',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fats' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $plan = NutritionPlan::create($data); // إنشاء خطة غذائية
        return response()->json($plan, 201); // إرجاع الخطة مع رمز الحالة 201
    }

    // عرض خطة غذائية مفصلة
    public function show(NutritionPlan $nutritionPlan)
    {
        $nutritionPlan->load('user'); // تحميل المستخدم المرتبط بالخطة
        return response()->json($nutritionPlan);
    }

    // تحديث خطة غذائية موجودة
    public function update(Request $request, NutritionPlan $nutritionPlan)
    {
        $data = $request->validate([
            'calories' => 'required|integer',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fats' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $nutritionPlan->update($data); // تحديث الخطة الغذائية
        return response()->json($nutritionPlan); // إرجاع الخطة المحدثة
    }

    // حذف خطة غذائية
    public function destroy(NutritionPlan $nutritionPlan)
    {
        $nutritionPlan->delete(); // حذف الخطة الغذائية
        return response()->json(['message' => 'Nutrition Plan deleted successfully']);
    }
}
