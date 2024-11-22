<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Career extends Model
{
    protected $fillable = [
        'name',
        'educational_institution',
        'educational_level'
    ];

    public function pensum(): HasOne
    {
        return $this->hasOne(Pensum::class);
    }

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
