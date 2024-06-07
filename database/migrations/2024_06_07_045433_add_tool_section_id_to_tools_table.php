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
        Schema::table('tools', function (Blueprint $table) {
            $table->unsignedBigInteger('tool_section_id'); // إضافة العمود
            $table->foreign('tool_section_id')->references('id')->on('tool_sections'); // تعريف المفتاح الأجنبي
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            //
        });
    }
};
