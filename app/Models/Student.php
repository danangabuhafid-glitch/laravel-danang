<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'major_id',
        'student_name',
        'phone',
        'is_active',
    ];

    public function major()
    {
        return $this->belongsTo(Majors::class, 'major_id');
    }

    public function locker()
    {
        return $this->hasOne(Locker::class, 'student_id');
    }
}
