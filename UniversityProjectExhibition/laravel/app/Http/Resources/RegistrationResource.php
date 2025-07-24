<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'student_id' => $this->student_id,
            'email'      => $this->email,
            'purpose'    => $this->purpose
        ];
    }
}

// <form route='/api/registrations' method="post">
//     <input type="text" name="student_id">
// </form>