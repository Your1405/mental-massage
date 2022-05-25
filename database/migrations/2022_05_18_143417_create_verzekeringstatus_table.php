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
        Schema::create('verzekeringstatus', function (Blueprint $table) {
            $table->id('clientID');
            $table->string('clientVerzekeringsStatus', 32);
            $table->string('clientVerzekeringsNummer', 32);
            $table->string('clientVerzekeringsType', 32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verzekeringstatus');
    }
};
