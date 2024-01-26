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




Route::post("register", [ApiController::class, "register"]);
Route::post("regiserEmployeur", [ApiController::class, "register_Employeur"]);
Route::post("regiserAdmin", [ApiController::class, "register_Admin"]);
Route::post("login", [ApiController::class, "login"]);




Route::group(["middleware" => ["auth:api"],], function(){

    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);
});



Route::middleware(['auth:api','UserAdmin'])->group( function(){
    Route::get('listeProfession',[ProfessionController::class,'liste']);
    Route::post("AjoutProfession", [ProfessionController::class, "store"]);
    Route::put('profession/edit/{profession}', [ProfessionController::class, 'update']);
    Route::delete('profession/delete/{id}',[ProfessionController::class, 'delete']);

    Route::post('user/modificationAdmin',[ApiGestionUserController::class, 'updateAmin']);
    Route::get('user/VoirEnsembleUser',[ApiGestionUserController::class, 'listeUser']);
    Route::put('user/deactivateCompteUser/{id}',[ApiGestionUserController::class, 'deactivateCompte']);
    Route::get('chercheUsersParProfession/{profession}', [ProfessionController::class, 'RecherUserParProfession']);
    Route::get('chercheOffreParProfession/{profession}', [ProfessionController::class, 'RecherOffreEmploiParProfession']);

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

        Route::post('user/modificationProfilEmployeur',[ApiGestionUserController::class, 'updateEmployeur']);
        Route::get('user/VoirProfilDesCandidat',[ApiGestionUserController::class, 'ProfilDesCandidat']);

        Route::post("AjoutEvaluation", [EvaluationController::class, "store"]);
        Route::get("ListeEvaluation", [EvaluationController::class, "show"]);
        Route::delete("SupprimerEvaluation/{evaluation}", [EvaluationController::class, "destroy"]);

       

    });


    Route::middleware(['CompteActive','auth:api','UserCandidat'])->group( function(){
    

        Route::get('listeCandidature',[CandidatureController::class,'liste']);
        Route::post("AjoutCandidature/{offre_emploi_id}", [CandidatureController::class, "store"]);
        // Route::put('Candidature/edit/{Candidature}',[CandidatureController::class, 'update']);
        Route::delete('Candidature/delete/{Candidature}',[CandidatureController::class, 'destroy']);

        Route::post('user/modificationProfil',[ApiGestionUserController::class, 'updateCandidat']);
    });



// Route::group(['middleware' => 'CompteActive'], function () {
//     // Les routes protégées ici nécessiteront également que l'utilisateur soit actif
//     Route::get('/dashboard', 'DashboardController@index');
//     // ...
// });





