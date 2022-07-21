<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker\Factory::create();

        $geslacht = $faker->randomElement($array = array(1, 2));
        $geslachtNaam = '';
        if($geslacht == 1){
            $geslachtNaam = 'male';
        } else {
            $geslachtNaam = 'female';
        }

        return [
            "clientVoornaam" => $faker->firstName($geslachtNaam),
            "clientNaam" => $faker->lastName(),
            "soortZorg" => $faker->randomElement($array = array(1, 2)),
            "clientGezinStatus" => $faker->randomElement($array = array(1, 2, 3, 4)),
            "clientGeboorteDatum" => $faker->date(),
            "clientRegistratieDatum" => $faker->date('Y-m-d', 'now'),
            "clientBurgelijkeStaat" => $faker->randomElement($array = array(1, 2, 3, 4)),
            "clientTelefoonNummer" => $faker->numerify('8######'),
            "clientHuisTelefoonNummer" => $faker->numerify('######'),
            "clientEmail" => $faker->email(),
            "clientEthniciteit" => $faker->randomElement($array = array(1, 2, 3, 4, 5, 6, 7, 8, 9)),
            "clientGeslacht" => $geslacht,
            "clientHuisarts" => $faker->name(),
            "clientVerwijzing" => $faker->randomElement($array = array(1, 2, 3)),
            "clientOpleiding" => $faker->randomElement($array = array("NATIN MBO", "Lyceum", "ADEK", "UNASAT", "SPI")),
            "clientBeroep" => $faker->jobTitle(),
            "clientWerkgever" => $faker->company(),
            "clientContactPersoonNaam" => $faker->name(),
            "clientContactPersoonNummer" => $faker->numerify('8######'),
            "clientVerzekeringsStatus" => 2
        ];
    }
}
