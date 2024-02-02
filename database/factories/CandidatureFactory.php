<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidature>
 */
class CandidatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'dateSoum' => $this->faker->date,
            'etatCan' => $this->faker->randomElement(['attente', 'accepter', 'rejeter']),
            'user_id' =>1,
            'offre_emploi_id' => 1,
            
        ];
    }
}
