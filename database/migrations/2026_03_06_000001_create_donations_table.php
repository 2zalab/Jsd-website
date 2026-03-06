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
            $table->string('external_reference')->unique();
            $table->string('campay_reference')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->unsignedInteger('amount');
            $table->string('currency', 10)->default('XAF');
            $table->string('payment_method')->nullable();   // mtn_momo, orange_money
            $table->string('operator')->nullable();         // MTN, ORANGE
            $table->enum('status', ['pending', 'successful', 'failed', 'cancelled'])->default('pending');
            $table->text('message')->nullable();            // message du donateur
            $table->text('description')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->json('campay_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
