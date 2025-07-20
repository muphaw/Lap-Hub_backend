<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'student_id' => $request->student_id,
            'password_hash' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'User registered']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('student_id',$request->student_id)->first();
        if(! $user || !Hash::check($request->password,$user->password_hash)){
            return response()->json(['message' => 'Invalid crendentials'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out']);
    }
}
