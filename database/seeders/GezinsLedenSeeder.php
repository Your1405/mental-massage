<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GezinsLedenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gezinsleden')->insert([
            [
                'gezinsLidId' => 1,
                'gezinsLidBeschrijving'=> 'Vader'
            ],
            [
                'gezinsLidId' => 2,
                'gezinsLidBeschrijving'=> 'Moeder'
            ],
            [
                'gezinsLidId' => 3,
                'gezinsLidBeschrijving'=> 'Kind'
            ],
            [
                'gezinsLidId' => 4,
                'gezinsLidBeschrijving'=> 'Alleenstaand'
            ],
        ]);
    }
}
