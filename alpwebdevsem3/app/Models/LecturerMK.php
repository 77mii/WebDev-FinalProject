<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LecturerMK extends Model
{
    protected $table = 'lecturer_mks'; // Explicit table name
    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'mk_id',
        'tahun',
        'semester',
        'lmk_status', // Add the new column
        'lmk_image',  // New attribute for storing image URLs or paths
        'additional_lecturers',
        'visibility', // Add visibility to fillable
    ];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'lmk_id');
    }
}
