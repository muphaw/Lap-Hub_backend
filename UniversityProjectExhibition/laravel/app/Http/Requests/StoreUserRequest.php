<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'student_id'         => 'required|exists:students,student_id',
            'password_hash'      => 'required|string'
        ];
    }
}
