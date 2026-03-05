<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');                         // JSD'26
            $table->unsignedSmallInteger('numero');        // 3
            $table->integer('annee');                      // 2026
            $table->text('theme')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('date_limite_inscription')->nullable();
            $table->string('lieu')->default('Maroua, Cameroun');
            $table->text('description')->nullable();
            $table->text('mot_president')->nullable();
            $table->unsignedInteger('stats_participants')->default(0);
            $table->unsignedInteger('stats_projets')->default(0);
            $table->unsignedInteger('stats_programmeurs')->default(0);
            $table->boolean('est_courante')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
