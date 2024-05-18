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
        Schema::table('extensions', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('levels', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
        Schema::table('curriculums', function (Blueprint $table) {
            $table->integer('teacher_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('many_tables', function (Blueprint $table) {
            //
        });
    }
};
