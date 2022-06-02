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
        Schema::create('useraccounttype', function (Blueprint $table) {
            $table->id('userAccountTypeId');
            $table->string('userAccountDescription', 32);
        });

        DB::table('useraccounttype')->insert([
            'userAccountTypeId' => 1,
            'userAccountDescription' => 'Specialist'
        ]);

        DB::table('useraccounttype')->insert([
            'userAccountTypeId' => 2,
            'userAccountDescription' => 'Admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('useraccounttype');
    }
};
