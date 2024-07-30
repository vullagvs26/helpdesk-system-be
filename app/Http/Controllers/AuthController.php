<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Developer;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:developers,email',
            'position' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $developer = Developer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'position' => $request->position,
            'description' => $request->description,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($developer);

        return response()->json([
            'token' => $token,
            'id' => $developer->id,
            'email' => $developer->email,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $developer = Developer::where('email', $request->email)->first();

        return response()->json([
            'token' => $token,
            'id' => $developer->id,
            'email' => $developer->email,
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }
}
