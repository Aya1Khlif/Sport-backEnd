<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::paginate(10);

        return response()->json($profiles, 201);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:profiles',
            'password' => 'required|string|min:8',
            'age' => 'required|string',
            'height' => 'required|string',
            'weight' => 'required|string',
            'goal' => 'required|string'
        ]);

        
        $data['password'] = bcrypt($data['password']);


        $profile = Profile::create($data);

        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        return response()->json($profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $request->only(['name', 'email', 'password', 'height', 'weight', 'goal']);

        // تشفير كلمة المرور إذا تم تحديثها
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $profile->update($data);
        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(['message' => 'Profile deleted successfully'], 204);
    }
}
