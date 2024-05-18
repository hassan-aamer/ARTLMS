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
        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('national_id')->nullable();
            $table->string('city')->nullable();
            $table->string('qualification')->nullable();
            $table->string('school_or_college')->nullable();
            $table->string('department')->nullable();
            $table->text('reason')->nullable();
            $table->enum('status', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_infos', function (Blueprint $table) {
            //
        });
    }
};
