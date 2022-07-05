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
        Schema::create('medewerker_info', function (Blueprint $table) {
            $table->bigInteger('userId')->primary();
            $table->string('userNaam', 32)->nullable(true);
            $table->string('userVoornaam', 32)->nullable(true);
            $table->date('userGeboortedatum')->nullable(true);
            $table->string('userGeslacht', 32)->nullable(true);
            $table->string('userProfielfoto', 64)->default('user.png');
            $table->string('userSpecialty', 32)->nullable(true);

            $table->foreign('userId')->references('userId')->on('medewerker');
        });

        DB::table('medewerker_info')->insert([
            'userId' => 1,
            'userNaam' => 'Karijopawiro',
            'userVoornaam' => 'Youri',
            'userGeboorteDatum' => '2003-05-14',
            'userGeslacht' => 1,
            'userSpecialty' => 'Admin'
        ]);

        DB::table('medewerker_info')->insert([
            'userId' => 2
        ]);
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
