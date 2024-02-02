<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profession;
use App\Models\OffreEmploi;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OffreEmploi>
 */
class OffreEmploiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $factory->define(OffreEmploi::class, function (Faker $faker) {
        
        return [
            //
            'typeContrat' =>$this->faker->word,
            'lieu' =>$this->faker->city,
            'description' =>$this->faker->paragraph,
            'experienceMinimum' => $this->faker->word,
            'slaireMinimum' => $this->faker->randomNumber(5),
            'etat' => $this->faker->randomElement(['nouveau', 'invalide', 'archiver']),
            'user_id' =>1,
            // function () {
            //     return factory(User::class)->create()->id;
            // },
            'profession_id' =>1,
            // function () {
            //     return factory(Profession::class)->create()->id;
            // },
        ];
    // });

    }
}
