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

        $validated['password_hash'] = bcrypt($validated['password_hash']);

        return response()->json(User::create($validated), 201);
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'password_hash' => 'sometimes|string',
            'student_id' => 'sometimes|string|exists:students,student_id',
        ]);

        if (isset($validated['password_hash'])) {
            $validated['password_hash'] = bcrypt($validated['password_hash']);
        }

        $user->update($validated);
        return $user;
    }

    public function destroy($id) {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
