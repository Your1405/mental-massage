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
        Schema::create('medewerker', function (Blueprint $table) {
            $table->id('userId');
            $table->bigInteger('userAccountTypeId');
            $table->string('userEmail', 32);
            $table->string('userPassword', 32);

            $table->foreign('userAccountTypeId')->references('userAccountTypeId')->on('useraccounttype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medewerker');
    }
};
