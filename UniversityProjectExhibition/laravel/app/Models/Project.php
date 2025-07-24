<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'user_id', 
        'project_detail', 
        'project_date',
        'project_link', 
        'project_image', 
        'collaborators'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}