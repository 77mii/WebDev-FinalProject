<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'namamk',
        'description',
        'smallimage',
        'longimage',
    ];

    public function lecturerMKs(): HasMany
    {
        return $this->hasMany(LecturerMK::class, 'mk_id');
    }
}
