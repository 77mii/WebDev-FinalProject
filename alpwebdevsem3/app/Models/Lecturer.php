<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturername',
        'email',
        'password',
        'pfp',
        'employeenumber',
    ];

    // One-to-Many Relationship with LecturerMK
    public function lecturerMKs(): HasMany
    {
        return $this->hasMany(LecturerMK::class, 'lecturer_id');
    }
}
