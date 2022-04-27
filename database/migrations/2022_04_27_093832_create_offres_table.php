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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->integer('entreprise_id');
            $table->integer('recruteur_id');
            $table->integer('contrat_id');
            $table->string('poste', 60);
            $table->string('description', 2500);
            $table->mediumInteger('salaire_min_annuel')->nullable();
            $table->mediumInteger('salaire_max_annuel')->nullable();
            $table->boolean('teletravail');
            $table->boolean('lettre_motivation');
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
        Schema::dropIfExists('offres');
    }
};
