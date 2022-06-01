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
            $table->bigInteger('soortZorg');
            $table->bigInteger('clientGezinStatus');
            $table->date('clientGeboorteDatum');
            $table->date('clientRegistratieDatum');
            $table->bigInteger('clientBurgelijkeStaat');
            $table->integer('clientTelefoonNummer');
            $table->integer('clientHuisTelefoonNummer');
            $table->string('clientEmail', 32);
            $table->bigInteger('clientEthniciteit');
            $table->bigInteger('clientGeslacht');
            $table->string('clientHuisarts', 32);
            $table->bigInteger('clientVerwijzing');
            $table->string('clientOpleiding', 32);
            $table->string('clientBeroep', 32);
            $table->string('clientWerkgever', 32);
            $table->bigInteger('clientContactPersoonId');
            $table->string('clientMedicatie', 32);
            $table->string('clientOnderliggendeZiekten', 32);
            $table->string('clientBehandelingStatus', 32);

            $table->foreign('soortZorg')->references('soortZorgId')->on('soortzorg');
            $table->foreign('clientBurgelijkeStaat')->references('burgerlijkestaatId')->on('burgerlijkestaat');
            $table->foreign('clientEthniciteit')->references('ethniciteitId')->on('ethniciteiten');
            $table->foreign('clientGeslacht')->references('geslachtId')->on('geslacht');
            $table->foreign('clientVerwijzing')->references('verwijzingId')->on('verwijzingen');
            $table->foreign('clientContactPersoonId')->references('clientContactPersoonId')->on('contactpersonen');
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
