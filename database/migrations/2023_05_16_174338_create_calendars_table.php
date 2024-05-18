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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['staging', 'final'])->default('final');
            $table->integer('curriculum_id')->nullable(); //if_final
            $table->integer('lesson_id')->nullable(); //if_staging_and_lesson
            $table->integer('course_id')->nullable(); // if_staging_and_course
            $table->enum('kind', ['theoretical', 'practical'])->nullable();
            $table->integer('degree')->nullable(); // if theoretical = 50
            $table->integer('duration')->nullable(); // if practical set value
            $table->enum('status', ['yes', 'no'])->default('yes');
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
