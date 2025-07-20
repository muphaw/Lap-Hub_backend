<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasOne(User::class,'student_id');
    }

    public function registrations()
    {
        return $this->hasOne(Registration::class,'student_id');
    }
}
