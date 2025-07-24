<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_id'            => $this->user_id,
            'student_id'         => $this->student_id,
            'password_hash'      => $this->password_hash
        ];
    }
}
