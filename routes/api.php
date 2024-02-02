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
    
    Route::post("AjoutProfession", [ProfessionController::class, "store"]);//T
    Route::put('profession/edit/{profession}', [ProfessionController::class, 'update']);//T
    Route::delete('profession/delete/{id}',[ProfessionController::class, 'delete']);//T

    Route::post('user/modificationAdmin',[ApiGestionUserController::class, 'updateAmin']);//T
    Route::get('user/VoirEnsembleUser',[ApiGestionUserController::class, 'listeUser']);//T
    Route::put('user/deactivateCompteUser/{id}',[ApiGestionUserController::class, 'deactivateCompte']);//T
    Route::get('chercheUsersParProfession/{profession}', [ProfessionController::class, 'RecherUserParProfession']);//T
    Route::get('chercheOffreParProfession/{profession}', [ProfessionController::class, 'RecherOffreEmploiParProfession']);//T
    Route::put('offres-emploi/{offreEmploi}', [OffreEmploiController::class, 'archiver']);
   
});



    Route::middleware(['CompteActive','auth:api','UserEmployeur'])->group( function(){
      
        Route::post("AjoutOffreEmploi", [OffreEmploiController::class, "store"]);//T
        Route::put('OffreEmploi/edit/{OffreEmploi}', [OffreEmploiController::class, 'update']);//T
        Route::delete('OffreEmploi/delete/{OffreEmploi}',[OffreEmploiController::class, 'destroy']);//T
        Route::get('chercheCandidatureParOffre/{OffreEmploi}', [OffreEmploiController::class, 'RecherCandidatureParOffre']);//T
       

        Route::get('AfichageCandidature',[CandidatureController::class,'show']);//T
        Route::put('ModifierAfichageCandidature/{candidature}', [CandidatureController::class, 'updateEtatCan']);//T
        Route::delete('SuppressionCandidature/{candidature}', [CandidatureController::class, 'SupprimerCandidature']);//T

        Route::post('user/modificationProfilEmployeur',[ApiGestionUserController::class, 'updateEmployeur']);//T
        Route::get('user/VoirProfilDesCandidat',[ApiGestionUserController::class, 'ProfilDesCandidat']);//T
        Route::get('chercheOffreParUser/{user}', [ApiGestionUserController::class, 'RecherOffreParUser']);//T


        Route::post("AjoutEvaluation", [EvaluationController::class, "store"]);//T
        Route::get("ListeEvaluation", [EvaluationController::class, "show"]);//T
        Route::delete("SupprimerEvaluation/{evaluation}", [EvaluationController::class, "destroy"]);//T

       

    });


    Route::middleware(['CompteActive','auth:api','UserCandidat'])->group( function(){
    
        Route::get('listeCandidatureDeChaqueCandidat',[CandidatureController::class,'ListeCandidatureDeChaqueCandidat']);
        Route::post("AjoutCandidature/{offre_emploi_id}", [CandidatureController::class, "store"]);//T
        Route::post('user/modificationProfil',[ApiGestionUserController::class, 'updateCandidat']);//T
    });



    Route::get('listeOffreEmploi',[OffreEmploiController::class,'liste']);//T
    Route::get('listeProfession',[ProfessionController::class,'liste']);//T
    Route::get('listeDesCandidats',[ApiGestionUserController::class,'listeCandidats']);//T

     // Route::put('Candidature/edit/{Candidature}',[CandidatureController::class, 'update']);
     Route::delete('Candidature/delete/{Candidature}',[CandidatureController::class, 'destroy']);









