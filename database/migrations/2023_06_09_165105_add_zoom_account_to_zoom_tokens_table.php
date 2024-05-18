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
        Schema::table('zoom_tokens', function (Blueprint $table) {
            $table->text('zoom_account_id')->nullable();
            $table->text('zoom_email')->nullable();
            $table->text('token_exp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zoom_tokens', function (Blueprint $table) {
            //
        });
    }
};
