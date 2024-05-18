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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('calendar_id');
            $table->integer('question_id');
            $table->string('calendar_title')->nullable();
            $table->text('question_title')->nullable();
            $table->string('question_type')->nullable();
            $table->string('question_kind')->nullable();
            $table->text('answer')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
