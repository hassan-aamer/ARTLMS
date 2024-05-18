<?php

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
        Schema::create('student_answer_degrees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('calendar_id');
            $table->string('login_degree')->nullable();
            $table->string('attendance_and_mission_degree')->nullable();
            $table->string('staging_calendars_degree')->nullable();
            $table->string('final_calendar_degree')->nullable();
            $table->string('student_final_degree')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answer_degrees');
    }
};
