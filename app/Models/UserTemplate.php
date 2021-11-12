<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    use HasFactory;

    protected $table = 'user_template';

    protected $primaryKey = 'id';

    protected $fillable = [
        'template_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        if ($value !== '') {
            $value = Carbon::parse($value)->format('Y-m-d H:i');
        }

        return $value;
    }

    public function template()
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}
