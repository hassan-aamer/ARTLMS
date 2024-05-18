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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->integer('scheduled_id')->default(0);
            $table->string('title');
            $table->text('short_description');
            $table->text('image');
            $table->enum('term', ['1', '2'])->default(1);
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('units');
    }
};
