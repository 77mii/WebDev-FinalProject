<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'sptitle',
        'sp_description', // Add this attribute
        'file_type',
        'project_id',
        'visibility', // Add visibility to fillable
    ];

    

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projectImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'sp_id');
    }

    // Add this relationship
    public function studentGroups(): HasMany
    {
        return $this->hasMany(StudentGroup::class, 'sp_id');
    }
}
