<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerwijzingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('verwijzingen')->insert([
            [
                'verwijzingId' => 1,
                'verwijzingNaam' => 'Dokter'
            ],
            [
                'verwijzingId' => 2,
                'verwijzingNaam' => 'Specialist'
            ],
            [
                'verwijzingId' => 3,
                'verwijzingNaam' => 'Zelf'
            ],
        ]);
    }
}
