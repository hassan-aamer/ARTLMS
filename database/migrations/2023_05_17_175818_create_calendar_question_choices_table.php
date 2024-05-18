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
        Schema::create('calendar_question_choices', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->string('choice_text')->nullable();
            $table->text('choice_file')->nullable();
            $table->string('choice_file_ext')->nullable();
            $table->string('choice_video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_question_choices');
    }
};
