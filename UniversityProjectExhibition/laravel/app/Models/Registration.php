<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registrations extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'email',
        'purpose',
        'created_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}