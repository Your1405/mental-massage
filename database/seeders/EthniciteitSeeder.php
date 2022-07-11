<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EthniciteitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ethniciteiten')->insert([
            [
                'ethniciteitId' => 1,
                'ethniciteitBeschrijving'=>'Hindustaan'
            ],
            [
                'ethniciteitId' => 2,
                'ethniciteitBeschrijving'=>'Creool'
            ],
            [
                'ethniciteitId' => 3,
                'ethniciteitBeschrijving'=>'Marron'
            ],
            [
                'ethniciteitId' => 4,
                'ethniciteitBeschrijving'=>'Javaan'
            ],
            [
                'ethniciteitId' => 5,
                'ethniciteitBeschrijving'=>'Inheems'
            ],
            [
                'ethniciteitId' => 6,
                'ethniciteitBeschrijving'=>'Chinees'
            ],
            [
                'ethniciteitId' => 7,
                'ethniciteitBeschrijving'=>'Blank'
            ],
            [
                'ethniciteitId' => 8,
                'ethniciteitBeschrijving'=>'Gemengd'
            ],
            [
                'ethniciteitId' => 9,
                'ethniciteitBeschrijving'=>'Ander'
            ],
        ]);
    }
}
