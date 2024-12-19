<?php

namespace App\Http\Controllers;

use App\Models\WorkoutSession;
use Illuminate\Http\Request;

class WorkoutSessionController extends Controller
{
  // استرجاع جميع الجلسات مع المستخدم المرتبط
  public function index()
  {
      $sessions = WorkoutSession::with('user', 'exercise')->get(); // إضافة التمرين المرتبط أيضًا
      return response()->json($sessions);
  }

  // إنشاء جلسة تمرين جديدة
  public function store(Request $request)
  {
      $data = $request->validate([
          'user_id' => 'required|exists:users,id', // التحقق من وجود المستخدم
          'exercise_id' => 'required|exists:exercises,id', // التحقق من وجود التمرين
          'date' => 'required|date', // التاريخ
          'duration' => 'required|integer', // المدة
          'status' => 'nullable|string', // الحالة
      ]);

      $session = WorkoutSession::create($data); // إنشاء الجلسة
      return response()->json($session, 201); // إرجاع الجلسة مع رمز 201
  }

  // استرجاع جلسة تمرين معينة
  public function show(WorkoutSession $workoutSession)
  {
      $workoutSession->load('user', 'exercise'); // تحميل المستخدم والتمرين المرتبط
      return response()->json($workoutSession);
  }

  // تحديث جلسة تمرين
  public function update(Request $request, WorkoutSession $workoutSession)
  {
      $data = $request->validate([
          'date' => 'required|date',
          'duration' => 'required|integer',
          'status' => 'nullable|string',
      ]);

      $workoutSession->update($data); // تحديث الجلسة
      return response()->json($workoutSession);
  }

  // حذف جلسة تمرين
  public function destroy(WorkoutSession $workoutSession)
  {
      $workoutSession->delete(); // حذف الجلسة
      return response()->json(['message' => 'Workout session deleted successfully']);
  }
}
