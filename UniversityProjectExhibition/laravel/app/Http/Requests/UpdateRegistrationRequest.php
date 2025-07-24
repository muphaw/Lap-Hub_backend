<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'email'      => 'sometimes|email',
            'purpose'    => 'nullable|string'
        ];
    }
}
