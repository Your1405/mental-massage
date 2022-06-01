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
        Schema::create('client_specialisten', function (Blueprint $table) {
            $table->bigInteger('clientId');
            $table->bigInteger('userId');

            $table->primary(['clientId', 'userId']);
            $table->foreign('clientId')->references('clientId')->on('clients');
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
        Schema::dropIfExists('client_specialisten');
    }
};
