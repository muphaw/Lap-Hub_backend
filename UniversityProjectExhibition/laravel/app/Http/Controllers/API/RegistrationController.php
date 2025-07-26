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
        return Registration::create($validated);
    }

    public function show($id) {
        return Registration::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->update($request->all());
        return $registration;
    }

    public function destroy($id) {
        Registration::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
