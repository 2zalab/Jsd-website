<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // These columns were mistakenly declared as json but hold single string values.
        // MariaDB's JSON CHECK constraint rejects unquoted strings like "Doctorat".
        // Strip any JSON quotes from existing data, then convert to VARCHAR.
        DB::statement("UPDATE programmeurs SET niveau_etude  = JSON_UNQUOTE(niveau_etude)  WHERE JSON_VALID(niveau_etude)");
        DB::statement("UPDATE programmeurs SET classe        = JSON_UNQUOTE(classe)        WHERE JSON_VALID(classe)");
        DB::statement("UPDATE programmeurs SET etablissement = JSON_UNQUOTE(etablissement) WHERE JSON_VALID(etablissement)");
        DB::statement("UPDATE programmeurs SET telephone     = JSON_UNQUOTE(telephone)     WHERE JSON_VALID(telephone)");

        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN niveau_etude  VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN classe        VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN etablissement VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN telephone     VARCHAR(255) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN niveau_etude  JSON NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN classe        JSON NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN etablissement JSON NOT NULL");
        DB::statement("ALTER TABLE programmeurs MODIFY COLUMN telephone     JSON NOT NULL");
    }
};
