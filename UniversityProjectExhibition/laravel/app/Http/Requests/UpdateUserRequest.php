<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'student_id'         => 'sometimes|exists:students,student_id',
            'password_hash'      => 'sometimes|string'
        ];
    }
}

