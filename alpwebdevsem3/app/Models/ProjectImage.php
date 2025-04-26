<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sp_id',
        'imageurl',
        'description',
    ];

    public function studentProject(): BelongsTo
    {
        return $this->belongsTo(StudentProject::class, 'sp_id');
    }
}
