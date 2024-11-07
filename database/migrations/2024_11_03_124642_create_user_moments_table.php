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
        Schema::create('user_moments', function (Blueprint $table) {
            $table->id();
            $table->text('file')->nullable();
            $table->string('ext')->nullable();
            $table->enum('type',['public','private'])->default('public');
            $table->foreignId('user_massage_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('user_pelanggan_id')->constrained()->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_moments');
    }
};
