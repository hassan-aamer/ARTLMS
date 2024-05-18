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
        Schema::create('scheduleds', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->string('title');
            $table->text('short_description');
            $table->text('image');
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
        Schema::dropIfExists('scheduleds');
    }
};
