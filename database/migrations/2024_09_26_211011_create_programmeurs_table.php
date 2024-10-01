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
        Schema::create('programmeurs', function (Blueprint $table) {
            $table->id();
           // $table->foreignId('concours_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->json('telephone');
            $table->string('email');
            $table->json('niveau_etude');
            $table->json('classe');
            $table->json('etablissement');
            $table->string('type_concours');
            $table->json('langages');
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
        Schema::dropIfExists('programmeurs');
    }
};
