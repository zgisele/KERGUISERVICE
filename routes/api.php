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




Route::post("register", [ApiController::class, "register"]);//T X
Route::post("regiserEmployeur", [ApiController::class, "register_Employeur"]);//T X  
Route::post("regiserAdmin", [ApiController::class, "register_Admin"]);//T X
Route::post("login", [ApiController::class, "login"]);//TX




Route::group(["middleware" => ["CompteActive","auth:api"],], function(){

    Route::get("profile", [ApiController::class, "profile"]);//x
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);//TX
    Route::post('user/ModifierLePasse',[ApiGestionUserController::class, 'ModifierLePasse']);
    Route::get('/reset-password',[ApiGestionUserController::class, 'showResetForm'])->name('reset-password');


});



Route::middleware(['auth:api','UserAdmin'])->group( function(){
    
    Route::post("AjoutProfession", [ProfessionController::class, "store"]);//T  /vx
    Route::post('profession/edit/{profession}', [ProfessionController::class, 'update']);//Tx
    Route::delete('profession/delete/{id}',[ProfessionController::class, 'delete']);//T /vx

    Route::post('user/modificationAdmin',[ApiGestionUserController::class, 'updateAmin']);//T  /vx
    Route::get('user/VoirEnsembleUser',[ApiGestionUserController::class, 'listeUser']);//T  /vx
    Route::put('user/deactivateCompteUser/{id}',[ApiGestionUserController::class, 'deactivateCompte']);//T /vx
    Route::put('user/activateCompteUser/{id}',[ApiGestionUserController::class, 'activateCompte']);
    Route::get('chercheUsersParProfession/{profession}', [ProfessionController::class, 'RecherUserParProfession']);//T /vx
    Route::get('chercheOffreParProfession/{profession}', [ProfessionController::class, 'RecherOffreEmploiParProfession']);//T /vx
    Route::put('offres-emploi/{offreEmploi}', [OffreEmploiController::class, 'archiver']);
    Route::get('chercheOffreParUser/{user}', [ApiGestionUserController::class, 'RecherOffreParUser']);//Tx
   
});



    Route::middleware(['CompteActive','auth:api','UserEmployeur'])->group( function(){
      
        Route::post("AjoutOffreEmploi", [OffreEmploiController::class, "store"]);//Tx

        //history des offres emplois d'un employeur
        Route::get('historieOffreEmployeur',[OffreEmploiController::class,'historieOffreEmployeur']);//T
        
        Route::post('OffreEmploi/edit/{OffreEmploi}', [OffreEmploiController::class, 'update']);//Tx
        Route::delete('OffreEmploi/delete/{OffreEmploi}',[OffreEmploiController::class, 'destroy']);//Tx
        Route::get('chercheCandidatureParOffre/{OffreEmploi}', [OffreEmploiController::class, 'RecherCandidatureParOffre']);//Tx
       

        // Route::get('AfichageCandidature',[CandidatureController::class,'show']);//T
        Route::get('AfichageCandidature',[CandidatureController::class,'AffichagelisteDesCanditatureRecuParEmployeur']);//Tx
        Route::put('ModifierAfichageCandidature/{candidature}', [CandidatureController::class, 'updateEtatCan']);//Tx
        Route::delete('SuppressionCandidature/{candidature}', [CandidatureController::class, 'SupprimerCandidature']);//Tx

        Route::post('user/modificationProfilEmployeur',[ApiGestionUserController::class, 'updateEmployeur']);//Tx
        Route::get('user/VoirProfilDesCandidat',[ApiGestionUserController::class, 'ProfilDesCandidat']);//Tx
        // Route::get('chercheOffreParUser/{user}', [ApiGestionUserController::class, 'RecherOffreParUser']);//T


        // Route::post("AjoutEvaluation", [EvaluationController::class, "store"]);//T
        Route::post("AjoutEvaluation/{id}", [EvaluationController::class, "store"]);//Tx

        //liste des commantaire au niveau du dashbord employeur
        Route::get("ListeEvaluationEmployeur", [EvaluationController::class, "showEmployeur"]);//x
        Route::delete("SupprimerEvaluation/{evaluation}", [EvaluationController::class, "destroy"]);//Tx

    });


    Route::middleware(['CompteActive','auth:api','UserCandidat'])->group( function(){
    
        Route::get('listeCandidatureDeChaqueCandidat',[CandidatureController::class,'ListeCandidatureDeChaqueCandidat']);//x
        Route::post("AjoutCandidature/{offre_emploi_id}", [CandidatureController::class, "store"]);//Tx
        Route::post('user/modificationProfil',[ApiGestionUserController::class, 'updateCandidat']);//Tx

        //liste des commantaire au niveau du dashbord candidat
        Route::get("ListeEvaluationCandidat", [EvaluationController::class, "showCandidat"]);//T
    });


    
    Route::get('listeOffreEmploi',[OffreEmploiController::class,'liste']);//Tx
    Route::get('listeProfession',[ProfessionController::class,'liste']);//T /vx
    Route::get('listeDesCandidats',[ApiGestionUserController::class,'listeCandidats']);//Tx
    Route::post('user/initialisaionMotDePasse',[ApiGestionUserController::class, 'updateMotDePasse']);

    //liste des commantaire page d'accueil
    Route::get("ListeEvaluation", [EvaluationController::class, "listeEvaluation"]);//T

     // Route::put('Candidature/edit/{Candidature}',[CandidatureController::class, 'update']);
    //  Route::delete('Candidature/delete/{Candidature}',[CandidatureController::class, 'destroy']);


//aficher la liste des offre par employeur
//l'afficher la liste des evaluation  pour candidat et pour employeur
//un employer ne doit pas supprimer une offre d'emploi mais archiver,pareile pour la candidature et commentare






