<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'project_id'     => $this->project_id,
            'user_id'        => $this->user_id,
            'project_name'   => $this->project_name,
            'project_detail' => $this->project_detail,
            'project_date'   => $this->project_date,
            'project_link'   => $this->project_link,
            'project_image'  => $this->project_image,
            'collaborators'  => $this->collaborators,
            'popularity'     => $this->popularity,
        ];
    }
}

