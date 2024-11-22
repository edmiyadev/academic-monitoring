<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pensum extends Model
{
    /** @use HasFactory<\Database\Factories\PensumFactory> */
    use HasFactory;

    protected $fillable = [
        'carrer_id'
    ];

    public function carrer(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)
            ->withPivot('semester', 'prerequisites')
            ->withTimestamps();
    }
}
