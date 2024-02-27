<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;
use Tymon\JWTAuth\Facades\JWTAuth;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;



class ProfessionTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    // public function test_Profession_peut_etre_ajouter()
    // {
        
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutProfession');
    //     $response->assertStatus(200);
        
    // }


    // public function test_lister_les_professions()
    // {

    //     $response = $this->get('api/listeProfession');

    //     $response->assertStatus(200);
        
        
    // }

    // public function test_modifier_une_professions()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/profession/edit/1');
    //     $response->assertStatus(200);
        
    // }
    // public function test_supprimer_une_professions()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/profession/delete/1');
    //     $response->assertStatus(200);
        
    // }

    // public function test_user_par_professions()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/chercheUsersParProfession/1');
    //     $response->assertStatus(200);
        
    // }
    // public function test_offre_par_profession()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/chercheOffreParProfession/1');
    //     $response->assertStatus(200);
        
    // }
}
