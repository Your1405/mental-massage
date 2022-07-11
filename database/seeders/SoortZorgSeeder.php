<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoortZorgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soortzorg')->insert([
            [
                'zorgId' => 1,
                'zorgBeschrijving'=> 'Eenmalig'
            ],
            [
                'zorgId' => 2,
                'zorgBeschrijving'=> 'Meerdermalig'
            ]
        ]);
    }
}
