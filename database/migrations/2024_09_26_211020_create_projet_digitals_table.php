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
    Schema::create('projet_digitals', function (Blueprint $table) {
        $table->id();
       // $table->foreignId('concours_id')->constrained()->onDelete('cascade');
        $table->string('nom_equipe');
        $table->string('chef_equipe');
        $table->string('email_chef_equipe');
        $table->string('etablissement');
        $table->string('niveau_etude');
        $table->string('classe');
        $table->string('nom_projet');
        $table->text('description_projet');
        $table->string('livre_projet')->nullable();
        $table->string('certificat_scolarite')->nullable();
        $table->string('lien_youtube')->nullable();
        $table->string('business_plan')->nullable();
        $table->string('type_concours'); // CMPDL ou CMPDS
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
        Schema::dropIfExists('projet_digitals');
    }
};
