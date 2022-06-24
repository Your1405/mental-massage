<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeslachtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geslacht')->insert([
            [
                'geslachtId' => 1,
                'geslachtNaam'=> 'Man'
            ],
            [
                'geslachtId' => 2,
                'geslachtNaam'=> 'Vrouw'
            ],
            [
                'geslachtId' => 3,
                'geslachtNaam'=> 'Ander'
            ],
        ]);
    }
}
