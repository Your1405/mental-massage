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
            $table->id('clientID');
            $table->date('afspraakDatum');
            $table->bigInteger('userID');
            $table->date('afspraakBegintijd');
            $table->date('afspraakEindtijd');
            $table->string('afspraakOmschrijving', 50);
            
        });

        DB::unprepared('ALTER TABLE `afspraken` DROP PRIMARY KEY, ADD PRIMARY KEY (  `clientID` ,  `afspraakDatum` )');
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
