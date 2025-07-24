<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'student_id' => 'required|string|unique:students,student_id',
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'major' => 'nullable|string',
            'batch' => 'nullable|string'
        ];
    }
}
