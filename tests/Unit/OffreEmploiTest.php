<?php

namespace Tests\Unit;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\OffreEmploi;

use App\Models\Profession;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;



class OffreEmploiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_liste_offre()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/listeOffreEmploi');
        $response->assertStatus(200);
        
    }

    public function test_offre_peut_etre_ajouter()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutOffreEmploi');
        $response->assertStatus(200);
        
    }

    // public function test_modifier_offre()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'employeur@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'employeur'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/OffreEmploi/edit/1');
    //     $response->assertStatus(200);
        
    // }
    public function test_modifier_offre()
    {
    Profession::factory()->create();
    // $offer = OffreEmploi::factory()->create(
    //     [
    //     // 'id' => 1,
    //     'typeContrat' =>'CDD',
    //     'lieu' => 'Dakar',
    //     'description' =>'salaire bien renumere',
    //     'experienceMinimum' =>'1 ans',
    //     'slaireMinimum' =>'20000' ,
    //     'etat' =>'nouveau',
    //     'user_id' =>1,
    //     'profession_id' =>1,
    //    ]
// );

    $user = User::factory()->create([
        'email' => 'employeur@example.com',
        'password' => bcrypt('password'),
        'role' => 'employeur'
    ]);

    OffreEmploi::factory()->create(['user_id' => $user->id, 'id' => 1]);

    $token = JWTAuth::fromUser($user);

    // Attempt to modify the employment offer with ID 1
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/OffreEmploi/edit/1');
    
    // Update the assertion to expect a 200 status code
    $response->assertStatus(200);
}

}
