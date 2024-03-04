<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Candidature;
use App\Models\OffreEmploi;
use App\Mail\AccepteCandidature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CandidatureController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FonctionsCandidatureTest extends TestCase
{
    use RefreshDatabase;

    private $candidatureController;
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
        $this->candidatureController = new CandidatureController();
        
    }

    public function test_store_candidature()
    {
        // Création d'un ID d'offre emploi fictif
        $offreEmploiId = 1;

        // Mock pour l'authentification de l'utilisateur
        // Auth::shouldReceive('user')->once()->andReturn((object)['id' => 1]);

        // Appel à la fonction store
        $response = $this->candidatureController->store($offreEmploiId);

        // Vérification si la candidature a été correctement enregistrée
        $this->assertDatabaseHas('candidatures', [
            'user_id' => 1,
            'offre_emploi_id' => $offreEmploiId,
        ]);

        // Vérification de la réponse JSON
        $response->assertJson([
            'status_code' => 200,
            'status_messages' => 'Candidatures enregistre avec succès',
        ]);
    }

    public function testDestroyExistingCandidature()
    {
        // Créer une candidature factice et la sauvegarder dans la base de données
        $candidature = Candidature::factory()->create([
            'created_at' => now(), // Format date valide
        ]);

        // Appeler la méthode SupprimerCandidature du contrôleur de candidature avec la candidature factice
        $response = $this->candidatureController->SupprimerCandidature($candidature);

        // Vérifier que la réponse est un objet JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Vérifier que la réponse contient un code de statut HTTP 200
        $this->assertEquals(200, $response->status());

        // Vérifier que la réponse contient un message indiquant que la candidature a été supprimée avec succès
        $responseData = $response->getData(true);
        $this->assertEquals(200, $responseData['status_code']);
        $this->assertEquals("La candidature a été Supprimée", $responseData['status_messages']);

        // Vérifier que la candidature a bien été supprimée de la base de données
        $this->assertNull(Candidature::find($candidature->id));
    }
    public function testUpdateEtatCanAccepter()
    {
        Mail::fake();
        
        // Création d'une candidature avec un état initial
        $candidature = Candidature::factory()->create(['etatCan' => 'attente']);
        
        // Création d'un utilisateur pour la candidature
        $candidat = User::factory()->create();
        $candidature->user_id = $candidat->id;
        $candidature->save();

        // Création d'une offre d'emploi
        $offreEmploi = OffreEmploi::factory()->create();
        $candidature->offre_emploi_id = $offreEmploi->id;
        $candidature->save();
        
        // Simulation de la requête et de la mise à jour de l'état de la candidature
        $response = $this->updateEtatCan('accepter', $candidature);

        // Vérification que l'état de la candidature a été mis à jour
        $this->assertEquals('accepter', $candidature->fresh()->etatCan);

        // Vérification de l'envoi du mail
        Mail::assertSent(AccepteCandidature::class, function ($mail) use ($candidat) {
            return $mail->hasTo($candidat->email);
        });

        // Vérification de la réponse de l'API
        $response->assertJson(['message' => 'La Candidature a ete accepter']);
    }

    // Test similaire pour l'état de rejet

    protected function updateEtatCan($etat, $candidature)
    {
        // Simule une requête HTTP pour mettre à jour l'état de la candidature
        return $this->postJson("/update-etat-can/{$candidature->id}", ['etatCan' => $etat]);
    }

}
