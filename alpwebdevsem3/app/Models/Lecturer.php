<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecturer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'lecturername',
        'email',
        'password',
        'pfp',
        'employeenumber',
    ];

    protected $hidden = [
        'password',
    ];

    // One-to-Many Relationship with LecturerMK
    public function lecturerMKs(): HasMany
    {
        return $this->hasMany(LecturerMK::class, 'lecturer_id');
    }
}
