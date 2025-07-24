<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize() { return true; }

    public function index()
    {
        return [
            'student_id' => 'required|exists:students,student_id',
            'email'      => 'required|email',
            'purpose'    => 'nullable|string'
        ];
    }
}
