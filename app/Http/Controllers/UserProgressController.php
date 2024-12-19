<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    public function index()
    {
        $progress = UserProgress::with('user')->get();
        return response()->json($progress);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'progress_details' => 'required|string',
            'date' => 'required|date',
        ]);

        $progress = UserProgress::create($data);
        return response()->json($progress, 201);
    }

    public function show(UserProgress $userProgress)
    {
        $userProgress->load('user');
        return response()->json($userProgress);
    }

    public function update(Request $request, UserProgress $userProgress)
    {
        $data = $request->validate([
            'progress_details' => 'required|string',
            'date' => 'required|date',
        ]);

        $userProgress->update($data);
        return response()->json($userProgress);
    }

    public function destroy(UserProgress $userProgress)
    {
        $userProgress->delete();
        return response()->json(['message' => 'User progress deleted successfully']);
    }
}
