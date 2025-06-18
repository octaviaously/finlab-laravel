<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username', 'name', 'email', 'password', 'points'
    ];
    protected $casts = [
    'completed_quizzes' => 'array',
];

}