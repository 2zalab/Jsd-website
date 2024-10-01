<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackathonsTable extends Migration
{
    public function up()
    {
        Schema::create('hackathons', function (Blueprint $table) {
            $table->id();
           // $table->foreignId('concours_id')->constrained()->onDelete('cascade');
            $table->string('nom_equipe');
            $table->integer('nombre_participants');
            $table->string('nom_chef_equipe');
            $table->string('telephone_chef_equipe');
            $table->string('email_chef_equipe');
            $table->string('etablissement');
            $table->string('niveau_etudes');
            $table->string('classe');
            $table->json('membres');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hackathons');
    }
}
