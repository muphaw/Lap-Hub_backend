<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index() {
        return Registration::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'student_id' => 'required|string|exists:students,student_id',
            'email' => 'required|email',
            'purpose' => 'required|string'
        ]);

        return response()->json(Registration::create($validated), 201);
    }

    public function show($id) {
        return Registration::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'sometimes|string|exists:students,student_id',
            'email' => 'sometimes|email',
            'purpose' => 'sometimes|string'
        ]);

        $registration->update($validated);
        return response()->json($registration, 200);
    }

    public function destroy($id) {
        Registration::destroy($id);
        return response()->json(['message' => 'Registration deleted successfully'], 200);
    }
}
