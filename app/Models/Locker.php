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
        'batch',
        'key_id',
        'student_id'
    ];

    public function key()
    {
        return $this->belongsTo(Keys::class, 'key_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
