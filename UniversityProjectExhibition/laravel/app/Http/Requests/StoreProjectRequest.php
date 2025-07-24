<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'user_id'       => 'required|exists:users,user_id',
            'project_name'  => 'required|string',
            'project_detail'=> 'nullable|string',
            'project_date'  => 'nullable|date',
            'project_link'  => 'nullable|url',
            'project_image' => 'nullable|string',
            'collaborators' => 'nullable|string',
            'popularity'    => 'nullable|integer',
        ];
    }
}
