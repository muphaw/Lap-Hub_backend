<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:students,email,' . $this->student_id . ',student_id',
            'major' => 'nullable|string',
            'batch' => 'nullable|string'
        ];
    }
}

