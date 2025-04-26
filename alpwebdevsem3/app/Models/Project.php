<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectname',
        'description',
        'status',
        'type',
        'projectimage',
        'lmk_id',
        'visibility', // Add visibility to fillable
    ];

    public function lecturerMK(): BelongsTo
    {
        return $this->belongsTo(LecturerMK::class, 'lmk_id');
    }

    public function studentProjects(): HasMany
    {
        return $this->hasMany(StudentProject::class, 'project_id');
    }

}
