<?php

namespace Database\Factories;
// use Faker\Generator as Faker;
// use App\Models\User;
// use App\Models\Profession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $factory->define(User::class, function (Faker $faker) {
        //     // Create a profession and get its id
        //     $profession = factory(Profession::class)->create();
      
      
        return [
            // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),


            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'imageDeProfil' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Vous pouvez utiliser bcrypt pour générer un mot de passe sécurisé.
            'telephone' => $this->faker->phoneNumber,
            'presentation' => $this->faker->text,
            'langueParler' => $this->faker->languageCode,
            'civilite' => $this->faker->randomElement(['M.', 'Mme', 'Dr', 'Prof']),
            'experienceProf' => $this->faker->text,
            'dateNaissance' => $this->faker->date,
            'lieu' => $this->faker->city,
            'statut' => $this->faker->randomElement(['activer', 'deactive']),
            'role' => $this->faker->randomElement(['candidat', 'employeur', 'admin']),
            'profession_id' => 1, // Assurez-vous que la plage est correcte.
            'created_at' => now(),
            'updated_at' => now(),
            // $this->faker->numberBetween(1, 10)
        ];
    // });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
