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
            $table->string('clientNaam', 32);
            $table->string('clientVoornaam', 32);
            $table->bigInteger('soortZorg');
            $table->bigInteger('clientGezinStatus');
            $table->date('clientGeboorteDatum');
            $table->date('clientRegistratieDatum');
            $table->bigInteger('clientBurgelijkeStaat');
            $table->integer('clientTelefoonNummer')->nullable();
            $table->integer('clientHuisTelefoonNummer')->nullable();
            $table->string('clientEmail', 32);
            $table->bigInteger('clientEthniciteit');
            $table->bigInteger('clientGeslacht');
            $table->string('clientHuisarts', 32);
            $table->bigInteger('clientVerwijzing');
            $table->string('clientOpleiding', 32);
            $table->string('clientBeroep', 64);
            $table->string('clientWerkgever', 64);
            $table->string('clientContactPersoonNaam', 64);
            $table->integer('clientContactPersoonNummer');
            $table->bigInteger('clientVerzekeringsStatus');
            $table->bigInteger('clientVerzekeringsMaatschappij')->nullable();
            $table->string('clientVerzekeringsNummer', 16)->nullable();
            $table->string('clientVerzekeringsType', 32)->nullable();
            $table->boolean('clientBehandelingStatus')->default(0);
            
            $table->foreign('soortZorg')->references('soortZorgId')->on('soortzorg');
            $table->foreign('clientBurgelijkeStaat')->references('burgerlijkestaatId')->on('burgerlijkestaat');
            $table->foreign('clientEthniciteit')->references('ethniciteitId')->on('ethniciteiten');
            $table->foreign('clientGeslacht')->references('geslachtId')->on('geslacht');
            $table->foreign('clientVerwijzing')->references('verwijzingId')->on('verwijzingen');
            $table->foreign('clientVerzekeringsStatus')->references('verzekeringsStatusId')->on('verzekeringstatus');
            $table->foreign('clientVerzekeringsMaatschappij')->references('verzekeringsMaatschappijId')->on('verzekeringsmaatschappij');
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
