<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Profession;
use App\Models\OffreEmploi;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvaluationTest extends TestCase
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

    public function test_evaluation_peut_etre_ajouter()
    {
        
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        Evaluation::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutEvaluation/1');
        $response->assertStatus(200);
        
    }
    public function test_liste_Evaluation_Employeur()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email'=>'employeur@example.com',
            'password'=>bcrypt('password'),
            'role'=>'employeur'
        ]);
        Evaluation::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/ListeEvaluationEmployeur');
        $response->assertStatus(200);
        
    }
    
    public function test_supprimer_Evaluation()
    {
        Profession::factory()->create();
        $user = User::factory()->create([
            'email' => 'employeur@example.com',
            'password' => bcrypt('password'),
            'role' => 'employeur'
        ]);
        Evaluation::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/SupprimerEvaluation/1');
        $response->assertStatus(200);
    }
}
