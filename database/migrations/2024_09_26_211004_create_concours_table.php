<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concours', function (Blueprint $table) {
            $table->id();
            $table->string('type_concours');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('niveau_etudes');
            $table->string('classe_secondaire')->nullable();
            $table->string('annee_superieur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concours');
    }
};
