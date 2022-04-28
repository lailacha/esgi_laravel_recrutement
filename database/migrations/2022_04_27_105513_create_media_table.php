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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('chemin', 255); //typeMedia/id_idUser_nom.extension
            $table->string('nom', 100);
            $table->string('extension', 10);
            $table->bigInteger('taille_en_ko');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('avatar_id')->after('id')->nullable();
            $table->integer('cv_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
};
