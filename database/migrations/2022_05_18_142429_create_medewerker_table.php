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
        Schema::create('medewerker', function (Blueprint $table) {
            $table->id('userId');
            $table->bigInteger('userAccountTypeId');
            $table->string('userEmail', 32);
            $table->string('userPassword', 32);

            $table->foreign('userAccountTypeId')->references('userAccountTypeId')->on('useraccounttype');
        });

        DB::table('medewerker')->insert([
            'userAccountTypeId' => 2,
            'userEmail' => 'karijopawiro@admin.sr',
            'userPassword' => 'password12'
        ]);

        DB::table('medewerker')->insert([
            'userAccountTypeId' => 1,
            'userEmail' => 'elle@user.sr',
            'userPassword' => 'password123'
        ]);
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
