<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GeslachtSeeder;
use Database\Seeders\SoortZorgSeeder;
use Database\Seeders\GezinsLedenSeeder;
use Database\Seeders\BurgelijkeStaatSeeder;
use Database\Seeders\EthniciteitSeeder;
use Database\Seeders\VerwijzingSeeder;
use Database\Seeders\VerzekeringsMaatschappijSeeder;
use Database\Seeders\VerzekeringsStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                GeslachtSeeder::class,
                SoortZorgSeeder::class,
                GezinsLedenSeeder::class,
                BurgelijkeStaatSeeder::class,
                EthniciteitSeeder::class,
                VerwijzingSeeder::class,
                VerzekeringsMaatschappijSeeder::class,
                VerzekeringsStatusSeeder::class
            ]
        );
    }
}
