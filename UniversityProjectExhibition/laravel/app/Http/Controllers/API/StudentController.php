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
        ]);
        return Student::create($validated);
    }

    public function show($id) {
        return Student::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return $student;
    }

    public function destroy($id) {
        Student::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}