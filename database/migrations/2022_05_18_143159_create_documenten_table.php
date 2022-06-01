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
        Schema::create('documenten', function (Blueprint $table) {
            $table->id('documentID');
            $table->bigInteger('clientId');
            $table->string('documentTitel', 32);
            $table->string('documentOmschrijving', 32);
            $table->string('documentURL', 32);

            $table->foreign('clientId')->references('clientId')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documenten');
    }
};
