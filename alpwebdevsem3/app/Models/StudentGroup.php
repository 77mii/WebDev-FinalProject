<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StudentGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupname',
        'sp_id',
    ];

    public function studentProject(): BelongsTo
    {
        return $this->belongsTo(StudentProject::class, 'sp_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_group_student', 'group_id', 'student_id');
    }
}
