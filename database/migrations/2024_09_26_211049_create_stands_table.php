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
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entreprise');
            $table->string('secteur_activite');
            $table->text('adresse');
            $table->string('email_contact');
            $table->string('telephone_contact');
            $table->string('taille_stand');
            $table->text('besoins_specifiques')->nullable();
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
        Schema::dropIfExists('stands');
    }
};
