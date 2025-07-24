<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'user_id'       => 'sometimes|exists:users,user_id',
            'project_name'  => 'sometimes|string',
            'project_detail'=> 'nullable|string',
            'project_date'  => 'nullable|date',
            'project_link'  => 'nullable|url',
            'project_image' => 'nullable|string',
            'collaborators' => 'nullable|string',
            'popularity'    => 'nullable|integer',
        ];
    }
}
