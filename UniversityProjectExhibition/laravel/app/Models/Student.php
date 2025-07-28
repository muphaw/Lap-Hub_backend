<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'major',
        'batch',
        'photo'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
