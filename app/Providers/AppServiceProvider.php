<?php

namespace App\Providers;

use App\Models\StudentEnrollment;
use App\Observers\StudentEnrollmentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        StudentEnrollment::observe(StudentEnrollmentObserver::class);
    }
}
