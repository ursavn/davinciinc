<?php

namespace App\Models;

use Carbon\Carbon;
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
        'role',
        'reset_key',
        'reset_expire',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    const ADMINISTRATOR = 1;
    const MANAGER       = 2;
    const EDITOR        = 3;

    public static $roles = [
        self::ADMINISTRATOR => 'Administrator',
        self::MANAGER       => 'Manager',
        self::EDITOR        => 'Editor',
    ];

    public function getCreatedAtAttribute($value)
    {
        if ($value !== '') {
            $value = Carbon::parse($value)->format('Y-m-d H:i');
        }

        return $value;
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value !== '') {
            $value = Carbon::parse($value)->format('Y-m-d H:i');
        }

        return $value;
    }

    public function setPasswordAttribute($value)
    {

        return $this->attributes['password'] = bcrypt($value);
    }
}
