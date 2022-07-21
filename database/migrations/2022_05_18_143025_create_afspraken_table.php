<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afspraken', function (Blueprint $table) {
            $table->id('afspraakId');
            $table->bigInteger('clientId');
            $table->date('afspraakDatum');
            $table->bigInteger('userId');
            $table->time('afspraakBegintijd');
            $table->time('afspraakEindtijd');
            $table->string('afspraakOmschrijving', 50);
            $table->integer('afspraakStatus')->default(0);

            $table->foreign('clientId')->references('clientId')->on('clients');
            $table->foreign('userId')->references('userId')->on('medewerker');
        });

        // DB::unprepared('ALTER TABLE `afspraken` DROP PRIMARY KEY, ADD PRIMARY KEY (  `clientID` ,  `afspraakDatum` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afspraken');
    }
};
