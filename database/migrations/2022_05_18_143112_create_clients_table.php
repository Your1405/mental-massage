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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('clientId');
            $table->string('clientVoornaam', 32);
            $table->string('soortZorg', 32);
            $table->string('clientGezinStatus', 32);
            $table->date('clientGeboorteDatum');
            $table->date('clientRegistratieDatum');
            $table->string('clientBurgelijkeStaat', 32);
            $table->integer('clientTelefoonNummer');
            $table->integer('clientHuisTelefoonNummer');
            $table->string('clientEmail', 32);
            $table->string('clientEthniciteit', 32);
            $table->string('clientGeslacht', 32);
            $table->string('clientHuisarts', 32);
            $table->string('clientVerwijzing', 32);
            $table->string('clientOpleiding', 32);
            $table->string('clientBeroep', 32);
            $table->string('clientWerkgever', 32);
            $table->string('clientContactPersoonID', 32);
            $table->string('clientProbleem', 32);
            $table->string('clientMedicatie', 32);
            $table->string('clientOnderliggendeZiekten', 32);
            $table->string('clientBehandelingStatus', 32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
