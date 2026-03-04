<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('type', ['photo', 'document']);
            $table->string('fichier')->nullable();    // nom du fichier image (photos) ou document
            $table->string('lien')->nullable();       // lien externe (YouTube, PDF hébergé, etc.)
            $table->enum('edition', ['JSD23', 'JSD26'])->default('JSD23');
            $table->string('categorie')->nullable();  // PDF, PPT, ZIP — pour les documents
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ressources');
    }
};
