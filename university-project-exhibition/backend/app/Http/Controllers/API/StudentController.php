<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() {
        return Student::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'student_id' => 'required|string|unique:students',
            'name' => 'required|string',
            'email' => 'required|email',
            'major' => 'required|string',
            'batch' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $data = $request->only(['student_id', 'name', 'email', 'major', 'batch']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('students', 'public');
            $data['photo'] = $path;
        }   
        return Student::create($validated);
        return response()->json([
        'message' => 'Student created successfully',
        'data' => $student,
        'photo_url' => $student->photo ? asset('storage/' . $student->photo) : null,
        ], 201);
    }

    public function show($id) {
        return Student::findOrFail($id);
    }

    public function update(Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'major' => 'required|string',
        'batch' => 'required|string',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $student->update($validated);
    return $student;
}

    public function destroy($id) {
        Student::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}