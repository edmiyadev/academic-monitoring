<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'career_id',
        'educational_level',
        'educational_institution',
    ];

//    public function user(): HasOne
//    {
//        return $this->hasOne(User::class);
//    }
}
