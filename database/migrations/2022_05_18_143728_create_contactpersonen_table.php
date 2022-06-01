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
        Schema::create('contactpersonen', function (Blueprint $table) {
            $table->id('contactPersoonId');
            $table->string('contactPersoonVoorNaam', 32);
            $table->string('contactPersoonAchterNaam', 32);
            $table->string('contactPersoonTelefoonNummer', 32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactpersonen');
    }
};
