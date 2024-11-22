<?php

use App\Models\Pensum;
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
        Schema::create('pensum_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pensum::class)->constrained();
            $table->foreignIdFor(Subject::class)->constrained();

            $table->unsignedTinyInteger('semester');
            $table->json('prerequisites')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pensum_subject');
    }
};
