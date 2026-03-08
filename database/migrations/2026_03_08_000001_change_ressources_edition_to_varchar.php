<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First update existing ENUM values to remove apostrophes if any edge cases exist
        // Then change column type to allow any edition name (e.g. JSD'24, JSD'26, etc.)
        DB::statement("ALTER TABLE ressources MODIFY COLUMN edition VARCHAR(20) NOT NULL DEFAULT 'JSD26'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE ressources MODIFY COLUMN edition ENUM('JSD23','JSD26') NOT NULL DEFAULT 'JSD23'");
    }
};
