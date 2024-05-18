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
        Schema::create('calendar_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('calendar_id');
            $table->enum('question_kind', ['theoretical', 'practical'])->default('theoretical');
            //If theoretical show this
            $table->string('title')->nullable();
            $table->text('question_file')->nullable();
            $table->string('question_file_ext')->nullable();
            $table->enum('question_type',['true_false','single_choice', 'multiple_choice']);
            //Else
            $table->text('question_photopia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_questions');
    }
};
