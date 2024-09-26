<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionConcoursTable extends Migration
{
    public function up()
    {
        Schema::create('inscription_concours', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->enum('type_concours', ['hackathon', 'programmation', 'projet_digital']);
            $table->text('motivation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscription_concours');
    }
}
