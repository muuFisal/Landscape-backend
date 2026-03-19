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
        Schema::create('request_service_sections', function (Blueprint $table) {
            $table->id();
            $table->json('small_label')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->json('button_text')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_service_sections');
    }
};
