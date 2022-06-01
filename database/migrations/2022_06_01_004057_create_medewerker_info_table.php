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
        Schema::create('medewerker_info', function (Blueprint $table) {
            $table->id('userId');
            $table->string('userNaam', 32);
            $table->string('userVoornaam', 32);
            $table->date('userGeboortedatum');
            $table->string('userGeslacht', 32);
            $table->binary('userProfielfoto', 32);
            $table->string('userSpecialty', 32);

            $table->foreign('userId')->references('userId')->on('medewerker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medewerker_info');
    }
};
