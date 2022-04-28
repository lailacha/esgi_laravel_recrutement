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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->integer('domaine_id');
            $table->string('identification', 30); // à voir avec gael
            $table->string('mail', 320);
            $table->string('tel', 15)->nullable();
            $table->integer('media_id')->nullable();
            $table->string('nom', 100);
            $table->string('description', 300);
            $table->string('adresse', 255);
            $table->string('code_postal', 32);
            $table->string('ville', 60);
            $table->integer('pays_id');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('entreprise_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entreprise');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('entreprise_id');
        });
    }
};
