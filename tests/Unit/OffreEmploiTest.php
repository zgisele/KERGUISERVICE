<?php

namespace Tests\Unit;
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

        $response = $this->get('api/listeOffreEmploi');
        $response->assertStatus(200);
        // Profession::factory()->create();
        // $user = User::factory()->create([
        //     'email'=>'employeur@example.com',
        //     'password'=>bcrypt('password'),
        //     'role'=>'employeur'
        // ]);
        // $token = JWTAuth::fromUser($user);
        // $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/listeOffreEmploi');
        // $response->assertStatus(200);
        
    }

    public function test_offre_peut_etre_ajouter()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        OffreEmploi::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutOffreEmploi');
        $response->assertStatus(200);
        
    }


    public function test_modifier_offre()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email' => 'employeur@example.com',
            'password' => bcrypt('password'),
            'role' => 'employeur'
        ]);
        OffreEmploi::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/OffreEmploi/edit/1');
        $response->assertStatus(200);
    }

    public function test_supprimer_offre()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email' => 'employeur@example.com',
            'password' => bcrypt('password'),
            'role' => 'employeur'
        ]);
        OffreEmploi::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/OffreEmploi/delete/1');
        $response->assertStatus(200);
    }

    public function test_Candidat_par_offre()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email' => 'employeur@example.com',
            'password' => bcrypt('password'),
            'role' => 'employeur'
        ]);
        OffreEmploi::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/chercheCandidatureParOffre/1');
        $response->assertStatus(200);
    }

}
