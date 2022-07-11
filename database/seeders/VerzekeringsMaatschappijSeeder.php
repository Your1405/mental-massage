<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerzekeringsMaatschappijSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verzekeringsmaatschappij')->insert([
            'verzekeringsMaatschappijId' => 1,
            'verzekeringsMaatschappijNaam' => 'Assuria'
        ]);

        DB::table('verzekeringsmaatschappij')->insert([
            'verzekeringsMaatschappijId' => 2,
            'verzekeringsMaatschappijNaam' => 'Self Reliance'
        ]);

        DB::table('verzekeringsmaatschappij')->insert([
            'verzekeringsMaatschappijId' => 3,
            'verzekeringsMaatschappijNaam' => 'Parsasco'
        ]);

        DB::table('verzekeringsmaatschappij')->insert([
            'verzekeringsMaatschappijId' => 4,
            'verzekeringsMaatschappijNaam' => 'SZF'
        ]);

        DB::table('verzekeringsmaatschappij')->insert([
            'verzekeringsMaatschappijId' => 5,
            'verzekeringsMaatschappijNaam' => 'Particulier'
        ]);
    }
}
