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
        Schema::create('why_choose_sections', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('why_choose_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('why_choose_section_id')->constrained('why_choose_sections')->onDelete('cascade');
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_section_items');
        Schema::dropIfExists('why_choose_sections');
    }
};
