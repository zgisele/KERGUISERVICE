<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;
use App\Models\OffreEmploi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\OffreEmploiController;
use App\Http\Requests\StoreOffreEmploiResquest;
use App\Http\Requests\UpdateOffreEmploiResquest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FonctionsOffreEmploiTest extends TestCase
{
    use RefreshDatabase;

    private $offreEmploiController;
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
        $this->offreEmploiController = new OffreEmploiController();
        
    }

    // public function testStoreOffreEmploiWithValidData()
    // {
    //     // Créer un utilisateur factice
    //     $user = User::factory()->create();
    //     $this->actingAs($user);
    //     // Créer une profession factice
    //     $profession = Profession::factory()->create();

    //     // Créer une instance de StoreOffreEmploiRequest avec des données valides simulées
    //     $requestData = [
    //         'typeContrat' => 'CDI',
    //         'lieu' => 'Paris',
    //         'description' => 'Description de l\'offre d\'emploi',
    //         'experienceMinimum' => '2 ans',
    //         'slaireMinimum' => 30000,
    //         'dateline' => '2024-12-31',
    //         // 'user_id' => $user->id,
    //         'profession_id' => $profession->id, // Supposons que l'ID de la profession existe dans la base de données
    //     ];

    //     // Créer un fichier simulé pour le téléchargement
    //     $file = UploadedFile::fake()->image('offre_emploi.jpg');

    //     // Créer une instance de Request avec les données simulées et le fichier simulé
    //     $storeOffreEmploiRequest = new StoreOffreEmploiResquest($requestData);
    //     $storeOffreEmploiRequest->files->set('image', $file);

        
    //     // Appeler la méthode store du contrôleur OffreEmploiController avec la demande simulée
    //     $response = $this->offreEmploiController->store($storeOffreEmploiRequest);

    //     // Vérifier que la réponse est un objet JsonResponse
    //     $this->assertInstanceOf(JsonResponse::class, $response);

    //     // Vérifier que la réponse contient un code de statut HTTP 200
    //     $this->assertEquals(200, $response->getStatusCode());

    //     // Vérifier que la réponse contient un message indiquant que l'offre d'emploi a été enregistrée avec succès
    //     $responseData = $response->getData(true);
    //     // $this->assertArrayHasKey('status', $responseData);
    //     // $this->assertEquals(true, $responseData['status']);
    //     // $this->assertEquals("Offre d'emploi enregistrée avec succès", $responseData['message']);
    // }

    public function testUpdateOffreEmploiWithValidData()
    {
        // Créer un utilisateur factice
        $user = User::factory()->create();

        // Créer une profession factice
        $profession = Profession::factory()->create();

        // Authentifier l'utilisateur factice
        $this->actingAs($user);

        // Créer une offre d'emploi factice et le sauvegarder dans la base de données
        $offreEmploi = OffreEmploi::factory()->create(['user_id' => $user->id,
        'profession_id' => $profession->id,]);

        // Créer une instance de UpdateOffreEmploiRequest avec des données valides simulées
        $requestData = [
            'typeContrat' => 'CDI',
            'lieu' => 'Paris',
            'description' => 'Nouvelle description de l\'offre d\'emploi',
            'experienceMinimum' => '3 ans',
            'slaireMinimum' => 35000,
            'dateline' => '2024-12-31',
            // 'user_id'=>$user->id,
            'profession_id' => $profession->id, // Supposons que l'ID de la profession existe dans la base de données
        ];

        // Créer un fichier simulé pour le téléchargement
        $file = UploadedFile::fake()->image('offre_emploi.jpg');

        // Créer une instance de Request avec les données simulées et le fichier simulé
        // $request = new Request($requestData);
       
        // Créer une instance de UpdateOffreEmploiRequest
        $updateOffreEmploiRequest = new UpdateOffreEmploiResquest($requestData);
        $updateOffreEmploiRequest->files->set('image', $file);
        

        // Appeler la méthode update du contrôleur OffreEmploiController avec la demande simulée et l'offre d'emploi existante
        $response = $this->offreEmploiController->update($updateOffreEmploiRequest, $offreEmploi);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que l'offre d'emploi a été modifiée avec succès
        $responseData = $response->getData(true);
        $this->assertTrue($responseData['status']);
        $this->assertEquals("l'Offre d'emploi a ete modifier  avec succes", $responseData['message']);
    }

    // public function testDestroyOffreEmploi()
    // {
    //     // Créer une offre d'emploi factice et la sauvegarder dans la base de données
    //     // $offreEmploi = OffreEmploi::factory()->create();
    //     $offreEmploi = OffreEmploi::factory()->create();

    //     // Appeler la méthode destroy du contrôleur OffreEmploiController avec l'offre d'emploi factice
    //     $response = $this->offreEmploiController->destroy($offreEmploi->id);

    //     // Vérifier que la réponse est un objet JsonResponse
    //     $this->assertInstanceOf(JsonResponse::class, $response);

    //     // Vérifier que la réponse contient un code de statut HTTP 200
    //     $this->assertEquals(200, $response->status());

    //     // Vérifier que la réponse contient un message indiquant que l'offre d'emploi a été supprimée avec succès
    //     $responseData = $response->getData(true);
    //     $this->assertEquals(200, $responseData['status_code']);
    //     $this->assertEquals("L'offre a été Supprimée", $responseData['status_messages']);

    //     // Vérifier que l'offre d'emploi a bien été supprimée de la base de données
    //     $this->assertNull(OffreEmploi::find($offreEmploi->id));
    // }
    // public function testDestroyExistingOffreEmploi()
    // {
    //     // Créer une offre d'emploi factice et la sauvegarder dans la base de données
    //     $offreEmploi = OffreEmploi::factory()->create();

    //     // Appeler la méthode destroy du contrôleur OffreEmploiController avec l'ID de l'offre d'emploi factice
    //     $offreEmploiController = new OffreEmploiController();
    //     $response = $offreEmploiController->destroy($offreEmploi->id);

    //     // Vérifier que la réponse est un objet JsonResponse
    //     $this->assertInstanceOf(JsonResponse::class, $response);

    //     // Vérifier que la réponse contient un code de statut HTTP 200
    //     $this->assertEquals(200, $response->status());

    //     // Vérifier que la réponse contient un message indiquant que l'offre d'emploi a été supprimée avec succès
    //     $responseData = $response->getData(true);
    //     $this->assertEquals(200, $responseData['status_code']);
    //     $this->assertEquals("L'offre a été Supprimée", $responseData['status_messages']);

    //     // Vérifier que l'offre d'emploi a bien été supprimée de la base de données
    //     $this->assertNull(OffreEmploi::find($offreEmploi->id));
    // }
}
