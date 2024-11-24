<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentEnrollment extends Model
{
  protected $fillable = [
    'student_id',
    'period_id',
    'subject_id'
  ];

  public function student(): BelongsTo
  {
    return $this->belongsTo(Profile::class);
  }


  public function period(): BelongsTo
  {
    return $this->belongsTo(Period::class);
  }

  public function subject(): BelongsTo
  {
    return $this->belongsTo(Subject::class);
  }
}
