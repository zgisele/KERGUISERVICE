<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\OffreEmploiController;
use App\Http\Controllers\Api\ApiGestionUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post("register", [ApiController::class, "register"]);//T
Route::post("regiserEmployeur", [ApiController::class, "register_Employeur"]);//T
Route::post("regiserAdmin", [ApiController::class, "register_Admin"]);//T
Route::post("login", [ApiController::class, "login"]);//T




Route::group(["middleware" => ["auth:api"],], function(){

    Route::get("profile", [ApiController::class, "profile"]);//T
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);//T
});



Route::middleware(['auth:api','UserAdmin'])->group( function(){
    Route::get('listeProfession',[ProfessionController::class,'liste']);
    Route::post("AjoutProfession", [ProfessionController::class, "store"]);//T
    Route::put('profession/edit/{profession}', [ProfessionController::class, 'update']);
    Route::delete('profession/delete/{id}',[ProfessionController::class, 'delete']);

    Route::post('user/modificationAdmin',[ApiGestionUserController::class, 'updateAmin']);//T
    Route::get('user/VoirEnsembleUser',[ApiGestionUserController::class, 'listeUser']);//T
    Route::put('user/deactivateCompteUser/{id}',[ApiGestionUserController::class, 'deactivateCompte']);//T
    Route::get('chercheUsersParProfession/{profession}', [ProfessionController::class, 'RecherUserParProfession']);
    Route::get('chercheOffreParProfession/{profession}', [ProfessionController::class, 'RecherOffreEmploiParProfession']);
    Route::get('chercheOffreParUser/{user}', [ApiGestionUserController::class, 'RecherOffreParUser']);

});



    Route::middleware(['CompteActive','auth:api','UserEmployeur'])->group( function(){
        Route::get('listeOffreEmploi',[OffreEmploiController::class,'liste']);
        Route::post("AjoutOffreEmploi", [OffreEmploiController::class, "store"]);
        Route::put('OffreEmploi/edit/{OffreEmploi}', [OffreEmploiController::class, 'update']);
        Route::delete('OffreEmploi/delete/{OffreEmploi}',[OffreEmploiController::class, 'destroy']);
        Route::get('chercheCandidatureParOffre/{OffreEmploi}', [OffreEmploiController::class, 'RecherCandidatureParOffre']);
       

        Route::get('AfichageCandidature',[CandidatureController::class,'show']);
        Route::put('ModifierAfichageCandidature/{candidature}', [CandidatureController::class, 'updateEtatCan']);
        Route::delete('SuppressionCandidature/{candidature}', [CandidatureController::class, 'SupprimerCandidature']);

        Route::post('user/modificationProfilEmployeur',[ApiGestionUserController::class, 'updateEmployeur']);//T
        Route::get('user/VoirProfilDesCandidat',[ApiGestionUserController::class, 'ProfilDesCandidat']);//T

        Route::post("AjoutEvaluation", [EvaluationController::class, "store"]);
        Route::get("ListeEvaluation", [EvaluationController::class, "show"]);
        Route::delete("SupprimerEvaluation/{evaluation}", [EvaluationController::class, "destroy"]);

       

    });


    Route::middleware(['CompteActive','auth:api','UserCandidat'])->group( function(){
    

        Route::get('listeCandidature',[CandidatureController::class,'liste']);
        Route::post("AjoutCandidature/{offre_emploi_id}", [CandidatureController::class, "store"]);
        Route::post('user/modificationProfil',[ApiGestionUserController::class, 'updateCandidat']);//T
    });

     // Route::put('Candidature/edit/{Candidature}',[CandidatureController::class, 'update']);
     Route::delete('Candidature/delete/{Candidature}',[CandidatureController::class, 'destroy']);









