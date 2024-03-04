<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Controllers\EvaluationController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FonctionsEvaluationTest extends TestCase
{
    use RefreshDatabase;

    private $evaluationController;
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
        $this->evaluationController = new EvaluationController();
        
    }
    public function testStoreEvaluationWithValidData()
    {
        // Créer un utilisateur factice Candidat
        $candidat = User::factory()->create();

        // Créer un utilisateur factice Employeur
        $employeur = User::factory()->create();

        // Simuler une authentification de l'utilisateur Employeur
        $this->actingAs($employeur);

        // Préparer les données de requête pour l'ajout d'une évaluation
        $requestData = [
            'appreciation' => 'Bonne performance',
        ];

        // Créer une instance de la demande de test avec les données préparées
        $request = new StoreEvaluationRequest($requestData);

        // Créer une instance du contrôleur d'évaluation
        // $evaluationController = new EvaluationController();

        // Appeler la méthode store du contrôleur d'évaluation avec les données de requête et l'ID du Candidat
        $response = $this->evaluationController->store($request, $candidat->id);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que l'évaluation a été ajoutée avec succès
        $responseData = $response->getData(true);
        $this->assertEquals(200, $responseData['status_code']);
        $this->assertEquals("Commentaire ajouté avec succès", $responseData['status_messages']);

        // Vérifier que l'évaluation a bien été ajoutée à la base de données
        $this->assertDatabaseHas('evaluations', [
            'appreciation' => $requestData['appreciation'],
            'employeur_id' => $employeur->id,
            'candidat_id' => $candidat->id,
        ]);
    }
    // public function testDestroyExistingEvaluation()
    // {
    //     // Créer une évaluation factice et la sauvegarder dans la base de données
    //     $evaluation = Evaluation::factory()->create();

    //     // Créer une instance du contrôleur d'évaluation
        

    //     // Appeler la méthode destroy du contrôleur d'évaluation avec l'évaluation factice
    //     $response =$this->evaluationController->destroy($evaluation);

    //     // Vérifier que la réponse est un objet JsonResponse
    //     $this->assertInstanceOf(JsonResponse::class, $response);

    //     // Vérifier que la réponse contient un code de statut HTTP 200
    //     $this->assertEquals(200, $response->status());

    //     // Vérifier que la réponse contient un message indiquant que l'évaluation a été supprimée avec succès
    //     $responseData = $response->getData(true);
    //     $this->assertEquals(200, $responseData['status_code']);
    //     $this->assertEquals("Le commentaire a été Supprimé", $responseData['status_messages']);

    //     // Vérifier que l'évaluation a bien été supprimée de la base de données
    //     $this->assertNull(Evaluation::find($evaluation->id));
    // }
}
