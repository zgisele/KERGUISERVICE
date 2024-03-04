<?php

namespace Tests\Unit;

use app;
use Tests\TestCase;
use App\Models\User;
// use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\CreatesApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\ApiGestionUserController;

class FonctionsUserTest extends TestCase
{

    use RefreshDatabase;
    use CreatesApplication;

    protected $apiController;
    protected $apiGestionUserController;
    /**
     * A basic unit test example.
     */
     protected function setUp(): void
    {
        parent::setUp();
        $this->apiController = new ApiController();
        $this->apiGestionUserController = new ApiGestionUserController();
    }

    // public function testUnitRegisterAdmin()
    // {
    //     //$imageUrl = asset('images/profil/logo.png');
    //     $imagePath = storage_path('app/images/zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg');
    //     $file = new \Illuminate\Http\UploadedFile($imagePath, 'zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg', 'image/jpg', null, true);

    //     $requestData = [
    //         'nom' => 'admin',
    //         'prenom' => 'prenomadmin',
    //         'imageDeProfil' =>$file,
    //         'email' => 'admin@example.com',
    //         'password' => 'password',
    //         'telephone' => '779999911',
    //         'lieu' => 'Dakar',
            
    //     ];

    //     $response = $this->json('POST', '/api/regiserAdmin', $requestData);

    //     $response->assertStatus(200);
    // }
    public function testUnitRegisterAdmin()
    {
        
        $file = UploadedFile::fake()->image('admin.jpg');
        $requestData =[
            'nom' => 'admin',
            'prenom' => 'prenomadmin',
            // 'imageDeProfil' => $file,
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'telephone' => '779999911',
            'lieu' => 'Dakar',
            
        ];

        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);
        $response = $this->apiController->register_Admin($request );
        
 
         $this->assertEquals(200, $response->getStatusCode());

        $responseData = $response->getData(true);
        $this->assertEquals(true, $responseData['status']);
        $this->assertEquals("Utilisateur enregistrer avec succes", $responseData['message']);

        $this->assertDatabaseHas('users', [
            'nom' => 'admin',
            'prenom' => 'prenomadmin',
            'email' => 'admin@example.com',
            // 'imageDeProfil' => $file,
            'password' => $requestData['password'],
            'telephone' => '779999911',
            'lieu' => 'Dakar',
        ]);
        
    }


    public function testUnitRegisterEmpoyeur()
    {
       
        // $imagePath = storage_path('app/images/zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg');
        // $file = new \Illuminate\Http\UploadedFile($imagePath, 'zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg', 'image/jpg', null, true);
        $file = UploadedFile::fake()->image('employeur.jpg');
        $requestData = [
            'nom' => 'emploiyeur',
            'prenom' => 'prenomemploiyeur',
            // 'imageDeProfil' =>$file,
            'email' => 'employeur@example.com',
            'password' =>Hash::make('password'),
            'telephone' => '779988911',
            'lieu' => 'Dakar',
            
            
        ];

        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);
        $response = $this->apiController->register_Employeur($request );
        
 
         $this->assertEquals(200, $response->getStatusCode());

        $responseData = $response->getData(true);
        $this->assertEquals(true, $responseData['status']);
        $this->assertEquals("Utilisateur enregistrer avec succes", $responseData['message']);

        $this->assertDatabaseHas('users', [
           
                'nom' => 'emploiyeur',
                'prenom' => 'prenomemploiyeur',
                'email' => 'employeur@example.com',
                'password' => $requestData['password'],
                'telephone' => '779988911',
                'lieu' => 'Dakar', 
          
        ]);
      
    }

    public function testUnitRegisterCandidat()
    {
       
        // $imagePath = storage_path('app/images/zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg');
        // $file = new \Illuminate\Http\UploadedFile($imagePath, 'zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg', 'image/jpg', null, true);
        $file = UploadedFile::fake()->image('employeur.jpg');
        $requestData = [
            'nom' => 'Cqndidat',
            'prenom' => 'prenomcandidat',
            // 'imageDeProfil' =>$file,
            'email' => 'candidat@example.com',
            'password' => Hash::make('password'),
            'telephone' => '779988911',
            'presentation' => 'je suis cuisiniere',
            'langueParler' => 'Français',
            'civilite' => 'Femme',
            'experienceProf' => 2,
            'dateNaissance' => '07/08/2000 ',
            'lieu' => 'Dakar',
            'profession_id' => 1,
            
            
        ];

        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);
        $response = $this->apiController->register($request );
        
 
         $this->assertEquals(200, $response->getStatusCode());

        $responseData = $response->getData(true);
        $this->assertEquals(true, $responseData['status']);
        $this->assertEquals("Utilisateur enregistrer avec succes", $responseData['message']);

        $this->assertDatabaseHas('users', [
                'nom' => 'Cqndidat',
                'prenom' => 'prenomcandidat',
                // 'imageDeProfil' =>$file,
                'email' => 'candidat@example.com',
                'password' =>$requestData['password'],
                'telephone' => '779988911',
                'presentation' => 'je suis cuisiniere',
                'langueParler' => 'Français',
                'civilite' => 'Femme',
                'experienceProf' => 2,
                'dateNaissance' => '07/08/2000 ',
                'lieu' => 'Dakar',
                'profession_id' => 1,
          
        ]);
    }
    
     //  le scénario où les informations d'identification sont valides et que la connexion reussi
    // public function test_it_logs_in_with_valid_credentials()
    // {


    //     $imagePath = storage_path('app/images/zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg');
    //     $file = new \Illuminate\Http\UploadedFile($imagePath, 'zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg', 'image/jpg', null, true);

    //     $user = User::factory()->create([
    //         'nom' => 'admin',
    //         'prenom' => 'prenomadmin',
    //         'imageDeProfil' =>$file,
    //         'email' => 'admin@example.com',
    //         'password' => bcrypt('password123'),
    //         'telephone' => '779999911',
    //         'lieu' => 'Dakar',
            
    //     ]);

    //     $response = $this->postJson('/api/login', [
    //         'email' => 'admin@example.com',
    //         'password' => 'password123',
    //     ]);

    //     $response->assertStatus(200)
    //         ->assertJsonStructure([
    //             'status',
    //             'message',
    //             'token',
    //             'data' =>[
    //                 'id',
    //                 'nom',
    //                 'prenom',
    //                 'email',
    //             ],
    //         ])
    //         ->assertJson([
    //             'status' => true,
    //             'message' => 'connexion reussi',
    //         ]);
    // }

    public function testUnitLogout()
    {
        // Authentifier un utilisateur fictif
        $user = User::factory()->create();
        $this->actingAs($user);
    
        // Appeler la méthode de déconnexion
        $response = $this->apiController->logout();
    
        // Vérifier que l'utilisateur est bien déconnecté
        $this->assertGuest();

        // Vérifier que la méthode renvoie une réponse JsonResponse
         $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient le message attendu
        $responseData = $response->getData(true);
        $this->assertEquals('Utilisateur deconnecter avec  succes', $responseData['message']);
    
        
    }

    // public function test_it_login_user_successfully_with_valid_credentials()
    // {

    //     // $imagePath = storage_path('app/images/zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg');
    //     // $file = new \Illuminate\Http\UploadedFile($imagePath, 'zw7TvQ7FPCd7v18kjpbKiGuvK0CkNEdowfkWIQiN.jpg', 'image/jpg', null, true);

    //     // $user = [
    //     //     'nom' => 'emploiyeur',
    //     //     'prenom' => 'prenomemploiyeur',
    //     //     'imageDeProfil' =>$file,
    //     //     'email' => 'employeur@example.com',
    //     //     'password' => 'password',
    //     //     'telephone' => '779988911',
    //     //     'lieu' => 'Dakar',
    //     // ];

    //     // Créer un objet Request avec les identifiants valides
    //     $request = new Request([
    //         'email' => 'admin@example.com',
    //         'password' => 'password123',
    //     ]);

    //     // Appeler la méthode login avec des identifiants valides
    //     $response = $this->apiController->login($request);
    //      // Vérifier que la réponse a un code de statut HTTP 200
    //     // $this->assertEquals(200, $response->getStatusCode());

    //     // // Vérifier que la réponse est une réponse JSON valide
    //     // $this->assertJson($response->getContent());

    //     // // Récupérer le contenu JSON de la réponse
    //     // $responseData = json_decode($response->getContent(), true);

    //     // // Vérifier que la réponse contient les clés attendues
    //     // $this->assertArrayHasKey('status', $responseData);
    //     // $this->assertArrayHasKey('message', $responseData);
    //     // $this->assertArrayHasKey('token', $responseData);
    //     // $this->assertArrayHasKey('data', $responseData);

    //     // // Vérifier que la clé 'status' est true dans la réponse JSON
    //     // $this->assertTrue($responseData['status']);

    //     // // Vérifier que la clé 'message' contient le message attendu
    //     // $this->assertEquals('connexion reussi', $responseData['message']);

    //     // // Vérifier que la clé 'token' est présente dans la réponse JSON
    //     // $this->assertArrayHasKey('token', $responseData['token']);


    //         // Obtenir le contenu JSON de la réponse
    //     $responseData = json_decode($response->getContent(), true);

    //     // Vérifier que le jeton d'accès est présent dans les données retournées
    //     $this->assertArrayHasKey('token', $responseData['data']);

    //     // Vérifier que la clé 'data' est présente dans les données retournées
    //     // $this->assertArrayHasKey('data', $responseData['data']);

    //     // Extraire le jeton d'accès des données retournées
    //     $token = $responseData['token'];
    //     // $userData = $responseData['data'];

    //     // Vérifier que les informations de l'utilisateur contiennent les champs attendus
    //         // $this->assertArrayHasKey('id', $userData);
    //         // $this->assertArrayHasKey('nom', $userData);
    //         // $this->assertArrayHasKey('imageDeProfil', $userData);
    //         // $this->assertArrayHasKey('email', $userData);
    //         // $this->assertArrayHasKey('password', $userData);
    //         // $this->assertArrayHasKey('email',  $userData );
    //         // $this->assertArrayHasKey('password',  $userData );
    //         // $this->assertArrayHasKey('telephone', $userData);
    //         // $this->assertArrayHasKey('lieu', $userData);

    //     // Définir les données attendues
    //     $expectedContent = [
    //         'status' => true,
    //         'message' => "connexion reussi",
    //         "token" => $token,
    //         // "data" => $userData,
    //     ];

    //     // Vérifier que les données retournées correspondent aux données attendues
    //     $this->assertEquals($expectedContent, $responseData);
            
            
    // }
    public function test_it_login_user_successfully_with_valid_credentials()
    {
         // Créer un utilisateur factice dans la base de données pour tester la connexion
          $user = User::factory()->create([
            'email' => 'admin@example.com', 
            'password' => bcrypt('password123'),
        ]);
            
        $validUser =[
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        // Créer une nouvelle demande avec les informations d'identification valides
        $request = new Request($validUser);

        // Appeler la méthode login avec des identifiants valides
        $response = $this->apiController->login( $request);

        // Vérifier que la réponse est un objet de type JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Obtenir le contenu JSON de la réponse
        $responseData = $response->getData(true);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200 (connexion réussie)
        $this->assertEquals(200, $response->status());

        // Vérifier que le jeton d'accès est présent dans les données retournées
        $this->assertArrayHasKey('token', $responseData);
       
        // Vérifier que le token n'est pas vide
        $this->assertNotEmpty($responseData['token']);
                
    }

    /** @test */
    public function test_it_does_not_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com', 
            'password' => bcrypt('password123'),
        ]);

        $validUser =[
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ];

        // Créer une nouvelle demande avec les informations d'identification valides
        $request = new Request($validUser);
        
        // Appeler la méthode login avec des identifiants valides
        $response = $this->apiController->login( $request);
     
         // Assurez-vous que la réponse contient le message approprié
         $expectedContent = [
           
            'status' => false,
           'message' => 'Invalid details'
         ];
         $this->assertEquals($expectedContent, json_decode($response->getContent(), true));
       
    }


    // Mise a jour utilisateur
    public function testUpdateEmployeurWithValidData()
    {
        // Créer un utilisateur factice dans la base de données pour tester la mise à jour du profil
        $file = UploadedFile::fake()->image('employeur.jpg');
        $user = User::factory()->create([
            'nom' => 'nomemploiyeur',
            'prenom' => 'prenomemploiyeur',
            'imageDeProfil' => $file,
            'telephone' => '779988911',
            'lieu' => 'Dakar',
            'password' => bcrypt('password123'),
        ]);

        // Simuler une demande de mise à jour de profil avec des données valides
        
        $requestData = [
            'nom' => 'Doe',
            'prenom' => 'John',
            // 'imageDeProfil' => $file, 
            'telephone' => '770987654',
            'lieu' => 'Updated City',
            'password' => 'newpassword123',
        ];
        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);

        // Simuler l'authentification de l'utilisateur
        $this->actingAs($user);

        // Appeler la méthode de mise à jour du profil du contrôleur API
        $response = $this->apiGestionUserController->updateEmployeur($request);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que le profil a été mis à jour avec succès
        $responseData = $response->getData(true);
        $this->assertEquals("Le profil a ete bien Modifié", $responseData['status_messages']);
    }

    public function testUpdateAminWithValidData()
    {
        // Créer un utilisateur factice dans la base de données pour tester la mise à jour du profil
        $file = UploadedFile::fake()->image('employeur.jpg');
        $user = User::factory()->create([
            'nom' => 'admin',
            'prenom' => 'prenomadmin',
            'imageDeProfil' => $file,
            'telephone' => '779999911',
            'lieu' => 'Dakar',
            'password' => bcrypt('password123'),
        ]);

        // Simuler une demande de mise à jour de profil avec des données valides
        
        $requestData = [
            'nom' => 'Doe',
            'prenom' => 'John',
            // 'imageDeProfil' => $file, 
            'telephone' => '770987654',
            'lieu' => 'Updated City',
            'password' => 'newpassword123',
        ];
        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);

        // Simuler l'authentification de l'utilisateur
        $this->actingAs($user);

        // Appeler la méthode de mise à jour du profil du contrôleur API
        $response = $this->apiGestionUserController->updateAmin($request);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que le profil a été mis à jour avec succès
        $responseData = $response->getData(true);
        $this->assertEquals("Le profil a ete bien Modifié", $responseData['status_messages']);
    }
    public function testUpdateCandidatWithValidData()
    {
        // Créer un utilisateur factice dans la base de données pour tester la mise à jour du profil
        $file = UploadedFile::fake()->image('employeur.jpg');
        $user = User::factory()->create([
            // 'nom' => 'admin',
            // 'prenom' => 'prenomadmin',
            // 'imageDeProfil' => $file,
            // 'telephone' => '779999911',
            // 'lieu' => 'Dakar',
            // 'password' => bcrypt('password123'),

            'nom' => 'Candidat',
            'prenom' => 'prenomcandidat',
            'imageDeProfil' =>$file,
            'telephone' => '779988911',
            'presentation' => 'je suis cuisiniere',
            'langueParler' => 'Français',
            'civilite' => 'Femme',
            'experienceProf' => 2,
            'dateNaissance' => '07/08/2000 ',
            'lieu' => 'Dakar',
            'password' => bcrypt('password123'),
            'profession_id' => 1,
        ]);

        // Simuler une demande de mise à jour de profil avec des données valides
        
        $requestData = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'telephone' => '770987654',

            'presentation' => 'je suis cuisiniere',
            'langueParler' => 'Français',
            'civilite' => 'Femme',
            'experienceProf' => 2,
            'dateNaissance' => '07/08/2000 ',

            'lieu' => 'Updated City',
            'password' => 'newpassword123',
            
            'profession_id' => 1,
        ];
        $request = new Request($requestData);
        $request->files->set('imageDeProfil', $file);

        // Simuler l'authentification de l'utilisateur
        $this->actingAs($user);

        // Appeler la méthode de mise à jour du profil du contrôleur API
        $response = $this->apiGestionUserController->updateCandidat($request);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que le profil a été mis à jour avec succès
        $responseData = $response->getData(true);
        $this->assertEquals("Le profil a ete bien Modifié", $responseData['status_messages']);
    }

    

    
}
