<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
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

    public function test_Profession_peut_etre_ajouter()
    {
        
        $user = User::factory()->create([
            'email'=>'admin@example.com',
            'password'=>bcrypt('password'),
            'role'=>'admin'
        ]);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/AjoutProfession');
        $response->assertStatus(302);
        
    }
}
