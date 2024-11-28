<?php

use App\Enums\StudentEnrollmentStatusEnum;
use App\Models\Period;
use App\Models\Profile;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Period::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Profile::class, 'student_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('status')->default(StudentEnrollmentStatusEnum::Pending);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};
