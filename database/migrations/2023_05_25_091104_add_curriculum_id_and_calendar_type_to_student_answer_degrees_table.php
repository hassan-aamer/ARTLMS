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
        Schema::table('student_answer_degrees', function (Blueprint $table) {
            $table->integer('curriculum_id')->nullable()->after('calendar_id');
            $table->string('calendar_type')->nullable()->after('curriculum_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answer_degrees', function (Blueprint $table) {
            //
        });
    }
};
