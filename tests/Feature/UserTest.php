<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;

// namespace Tests\Unit;


class UserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // public function test_user_candidat_can_register()
    // {
        
    //     // $user = User::factory()->create();
    //      Profession::factory()->create();
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->post('/api/register');
    //     $response->assertStatus(302);
       
    // }
    // public function test_user_employeur_can_register()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->post('/api/regiserEmployeur');
    //     $response->assertStatus(302);
       
    // }

    // public function test_user_admin_can_register()
    // {
    //     Profession::factory()->create();
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->post('/api/regiserAdmin');
    //     $response->assertStatus(302);
       
    // }

    // // Authentification des utilisateurs

    // public function test_user_can_login()
    // {
    //     Profession::factory()->create();
    //     $user= User::factory()->create();
    //     $connexion= ['email'=>$user->email,'password'=>'password'];
    //     $response = $this->post('/api/login',$connexion);
    //     $response->assertStatus(200);
    // }

    // // deconnexion des utilisateurs
    // public function test_user_can_logout()
    // {
    //     // $imageFile = UploadedFile::fake()->image('profile_picture.jpg');

    //     // // Enregistrer le fichier factice dans le stockage
    //     // $path = Storage::putFile('images', $imageFile);

    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'password' => bcrypt('password'),    
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer' . $token)->get('api/logout');
    //     $response->assertStatus(200);
    // }

    //  // l'admin peut voir tout les  utilisateurs inscrit

    // public function test_user_admin_can_view_liste_auther_user()
    //  {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
        
    //     $response = $this->withHeader('Authorization', 'Bearer' . $token)->get('api/user/VoirEnsembleUser');
    //     $response->assertStatus(200);
    //  }

    //  // l'employeur peut voir le profil des candidature

    // public function test_user_employeur_can_view_liste_auther_user()
    //  {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'employeur@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'employeur'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
        
    //     $response = $this->withHeader('Authorization', 'Bearer' . $token)->get('api/user/VoirProfilDesCandidat');
    //     $response->assertStatus(200);
    //  }


    // //  chaque user peut voir son profil
    // public function test_user_peut_voir_son_profil()
    //  {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'user@example.com',
    //         'password'=>bcrypt('password'),
            
    //     ]);
    //     $token = JWTAuth::fromUser($user);
        
    //     $response = $this->withHeader('Authorization', 'Bearer' . $token)->get('api/profile');
    //     $response->assertStatus(200);
    //  }

    //  //  chaque user candidat peut modifier son profil

    //  public function test_user_candidat_peut_modifier_son_profil()
    //    {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'candidat@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'candidat'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/user/modificationProfil');
    //     $response->assertStatus(200);
    //    }

    //  //  chaque user employeur peut modifier son profil

    //  public function test_user_employeur_peut_modifier_son_profil()
    //    {

    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'employeur@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'employeur'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/user/modificationProfilEmployeur');
    //     $response->assertStatus(200);
    //    }

    //  //  chaque user admin peut modifier son profil

    //  public function test_user_admin_peut_modifier_son_profil()
    //    {
    //     Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin'
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/user/modificationAdmin');
    //     $response->assertStatus(200);
    //    }

    // //    un user admin peut deactive le compte des user admine et candidat

    //  public function test_user_admin_peut_deactiver_son_profil()
    //    {
    //     // Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin' 
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/user/deactivateCompteUser/1');
    //     $response->assertStatus(200);
    //    }

    //    public function test_recherche_orffre_par_user()
    //    {
    //     // Profession::factory()->create();
    //     $user = User::factory()->create([
    //         'email'=>'admin@example.com',
    //         'password'=>bcrypt('password'),
    //         'role'=>'admin' 
    //     ]);
    //     $token = JWTAuth::fromUser($user);
    //     $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/chercheOffreParUser/1');
    //     $response->assertStatus(200);
    //    }

    //    public function test_liste_candidat()
    //    {
   
    //        $response = $this->get('api/listeDesCandidats');
    //        $response->assertStatus(200);
           
    //    }
}
