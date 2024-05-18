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
        Schema::table('zooms', function (Blueprint $table) {
            $table->text('meeting_id')->nullable();
            $table->text('start_url')->nullable();
            $table->text('host_id')->nullable();
            $table->text('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zooms', function (Blueprint $table) {
            //
        });
    }
};
