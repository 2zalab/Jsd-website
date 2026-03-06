<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('external_reference')->unique(); // notre référence interne
            $table->string('campay_reference')->nullable();  // référence retournée par CamPay
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedInteger('amount');
            $table->string('currency', 10)->default('XAF');
            $table->string('operator')->nullable();          // MTN, ORANGE
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending');
            $table->text('description')->nullable();
            $table->json('campay_data')->nullable();         // réponse brute CamPay
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
