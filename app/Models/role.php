<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable = [
        'role_name',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
