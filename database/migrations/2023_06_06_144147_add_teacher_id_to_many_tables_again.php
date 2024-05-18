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
        Schema::table('calendars', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('galleries', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('scheduleds', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('calendar_questions', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('many_tables_again', function (Blueprint $table) {
            //
        });
    }
};
