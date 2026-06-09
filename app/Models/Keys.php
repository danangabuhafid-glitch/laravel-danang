<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function locker()
    {
        return $this->hasOne(Locker::class, 'key_id');
    }
}
