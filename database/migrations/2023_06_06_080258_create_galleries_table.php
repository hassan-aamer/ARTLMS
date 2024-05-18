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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('video_link')->nullable();
            $table->text('knowledge_desc')->nullable();
            $table->text('performance_desc')->nullable();
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
        Schema::dropIfExists('galleries');
    }
};
