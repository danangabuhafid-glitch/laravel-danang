<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'instructor_name',
        'phone',
        'is_active',
        'user_id',
    ];

    public function major()
    {
        return $this->belongsTo(Majors::class, 'major_id');
    }
}
