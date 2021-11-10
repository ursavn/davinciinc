<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'img_url',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
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

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updater()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
