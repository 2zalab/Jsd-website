<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('currency');
            }
            if (!Schema::hasColumn('donations', 'message')) {
                $table->text('message')->nullable()->after('description');
            }
            if (!Schema::hasColumn('donations', 'email_sent')) {
                $table->boolean('email_sent')->default(false)->after('message');
            }
            if (!Schema::hasColumn('donations', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('email_sent');
            }
            // Ajouter 'cancelled' à l'enum status si pas déjà fait
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'message', 'email_sent', 'paid_at']);
        });
    }
};
