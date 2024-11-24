<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pensum extends Model
{
    protected $fillable = ['career_id'];

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
