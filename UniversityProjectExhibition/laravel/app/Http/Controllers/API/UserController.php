<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|string|unique:users',
            'student_id' => 'required|string|exists:students,student_id',
            'password_hash' => 'required|string',
        ]);
        return User::create($validated);
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}