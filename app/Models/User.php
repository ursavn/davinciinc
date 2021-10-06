<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];
}
