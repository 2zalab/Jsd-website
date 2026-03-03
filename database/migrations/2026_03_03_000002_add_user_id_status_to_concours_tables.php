<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $tables = ['programmeurs', 'projet_digitals', 'hackathons', 'stands'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedBigInteger('user_id')->nullable()->after('id');
                $blueprint->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('user_id');
                $blueprint->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        $tables = ['programmeurs', 'projet_digitals', 'hackathons', 'stands'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                $blueprint->dropForeign([$table . '_user_id_foreign'] ?? ['user_id']);
                $blueprint->dropColumn(['user_id', 'status']);
            });
        }
    }
};
