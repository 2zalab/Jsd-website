<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('logo');                   // nom du fichier image dans public/images/
            $table->string('lien')->nullable();       // URL du site partenaire
            $table->integer('ordre')->default(0);     // ordre d'affichage
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
