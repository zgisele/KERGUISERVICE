<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\Profession;
use Tests\CreatesApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\ProfessionController;
use App\Http\Requests\StoreProfessionResquest;
use App\Http\Requests\UpdateProfessionResquest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FonctionsProfessionTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected $professionController;
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }
    protected function setUp(): void
    {
        parent::setUp();
        $this->professionController = new ProfessionController();
        
    }

    public function testStoreProfessionWithValidData()
    {

        $file = UploadedFile::fake()->image('profession.jpg');

        $requestData =[

            "nom_prof"=>"Cuisinier",
            // "image"=>UploadedFile::fake()->image('profession.jpg'),
            "description" => "Description de la profession test",
            
        ];

        $storeProfessionResquest = new StoreProfessionResquest($requestData);
        $storeProfessionResquest->files->set('image', $file);
       
        $response = $this->professionController ->store( $storeProfessionResquest );

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);
        
 
         $this->assertEquals(200,$response->status());

        $responseData = $response->getData(true);
        $this->assertEquals(true, $responseData['status']);
        $this->assertEquals("Profession enregistrer avec succes", $responseData['message']);
       
        
    }

    public function testUpdateProfessionWithValidData()
    {
        // Créer une profession factice dans la base de données pour tester la mise à jour
        $profession =Profession::factory()->create();


        $file = UploadedFile::fake()->image('profession.jpg');

        // Créer une instance de la classe UpdateProfessionRequest avec des données valides
        $requestData = [
            'nom_prof' => 'Nouveau nom de profession',
            // 'image' => UploadedFile::fake()->image('updated_profession.jpg'),
            'description' => 'Nouvelle description de la profession',
        ];
        // $request = new Request($requestData);

        // Créer une instance de UpdateProfessionRequest
        $updateProfessionRequest = new UpdateProfessionResquest($requestData);
        $updateProfessionRequest->files->set('image', $file);
        // $updateProfessionRequest->merge($requestData);

        // Appeler la méthode update du contrôleur ProfessionController
        $response =$this->professionController->update($updateProfessionRequest, $profession);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que la profession a été mise à jour avec succès
        $responseData = $response->getData(true);
        $this->assertEquals(200, $responseData['status_code']);
        $this->assertEquals("La profession a ete Modifié", $responseData['status_messages']);

        // Vérifier que les données de profession dans la réponse correspondent aux données mises à jour
        $this->assertEquals($requestData['nom_prof'], $responseData['data']['nom_prof']);
        $this->assertEquals($requestData['description'], $responseData['data']['description']);
    }

    public function testDeleteExistingProfession()
    {
        // Créer une profession factice dans la base de données pour tester la suppression
        $profession =Profession::factory()->create();

        // Appeler la méthode delete du contrôleur ProfessionController avec l'ID de la profession factice
        
        $response = $this->professionController->delete($profession->id);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que la profession a été supprimée avec succès
        $responseData = $response->getData(true);
        $this->assertEquals(200, $responseData['status_code']);
        $this->assertEquals("La profession  a ete Supprimé", $responseData['status_messages']);

        // Vérifier que les données de profession dans la réponse correspondent aux données de la profession supprimée
        $this->assertEquals($profession->id, $responseData['data']['id']);
    }

    public function testDeleteNonExistingProfession()
    {
        // Appeler la méthode delete du contrôleur ProfessionController avec un ID de profession inexistant
        $response =$this->professionController->delete(9); // ID de profession inexistant

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 404 (non trouvé)
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message d'erreur indiquant que la profession n'a pas été trouvée
        // $responseData = $response->getData(true);
        
    }

}
