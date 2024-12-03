<?php

namespace App\Observers;

use App\Enums\PeriodStatusEnum;
use App\Enums\StudentEnrollmentStatusEnum;
use App\Models\Period;
use App\Models\StudentEnrollment;

class StudentEnrollmentObserver
{
    /**
     * Handle the StudentEnrollment "created" event.
     */
    public function created(StudentEnrollment $studentEnrollment): void
    {
        //
    }

    /**
     * Handle the StudentEnrollment "updated" event.
     */
    public function updated(StudentEnrollment $studentEnrollment): void
    {
        $periods = StudentEnrollment::where('period_id', $studentEnrollment->period_id)->where('status', StudentEnrollmentStatusEnum::Progress)->get();
        $period = Period::find($studentEnrollment->period_id);

        if ($periods->isEmpty()) {
            $period->status = PeriodStatusEnum::Finalized->value;
            $period->save();
        } else {
            $period->status = PeriodStatusEnum::In_progress->value;
            $period->save();
        }

    }

    /**
     * Handle the StudentEnrollment "deleted" event.
     */
    public function deleted(StudentEnrollment $studentEnrollment): void
    {
        //
    }

    /**
     * Handle the StudentEnrollment "restored" event.
     */
    public function restored(StudentEnrollment $studentEnrollment): void
    {
        //
    }

    /**
     * Handle the StudentEnrollment "force deleted" event.
     */
    public function forceDeleted(StudentEnrollment $studentEnrollment): void
    {
        //
    }
}
