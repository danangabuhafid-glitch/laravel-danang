<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'locker_code',
        'locker_name',
        'locker_description',
        'major',
        'locker_status',
        'batch'
    ];
}
