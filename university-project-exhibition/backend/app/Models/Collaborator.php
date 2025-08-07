<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name', 'email', 'major', 'batch', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //to off laravel atomatic timestamps 
    public $timestamps = false;
}
