<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerzekeringsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verzekeringstatus')->insert([
            'verzekeringStatusId' => 1,
            'verzekeringsStatus' => 'Verzekerd'	
        ]);

        DB::table('verzekeringstatus')->insert([
            'verzekeringStatusId' => 2,
            'verzekeringsStatus' => 'Niet verzekerd'	
        ]);
    }
}
