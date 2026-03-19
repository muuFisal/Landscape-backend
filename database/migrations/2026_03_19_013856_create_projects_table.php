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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('short_description')->nullable();
            $table->string('year')->nullable();
            $table->json('location')->nullable();
            $table->json('area')->nullable();
            $table->json('challenge_title')->nullable();
            $table->json('challenge_description')->nullable();
            $table->json('solution_title')->nullable();
            $table->json('solution_description')->nullable();
            $table->json('facts')->nullable(); // For dynamic tags/facts
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
