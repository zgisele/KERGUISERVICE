<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;
use App\Models\Candidature;
use App\Models\OffreEmploi;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CandidatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_Affichage_Candidature()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        // Candidature::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/AfichageCandidature');
        $response->assertStatus(200);
    }

    public function test_modifier_Candidature()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        Candidature::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/ModifierAfichageCandidature/1');
        $response->assertStatus(200);
    }

    public function test_Supprimer_Candidature()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        Candidature::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/SuppressionCandidature/1');
        $response->assertStatus(200);
    }

    public function test_Ajouter_Candidature()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'candidat@example.com',
            'password'=>bcrypt('password'),
            'role'=>'candidat'
        ]);
        // Candidature::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutCandidature/1');
        $response->assertStatus(200);
    }

    public function test_Afficher_liste_Candidature_De_Chaque_Candidat()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'candidat@example.com',
            'password'=>bcrypt('password'),
            'role'=>'candidat'
        ]);
        Candidature::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/listeCandidatureDeChaqueCandidat');
        $response->assertStatus(200);
    }
}
