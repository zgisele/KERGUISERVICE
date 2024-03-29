<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
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
            'appreciation' => $this->faker->sentence,
            // 'user_id' =>1,
            'employeur_id'=>1,
            'candidat_id'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
