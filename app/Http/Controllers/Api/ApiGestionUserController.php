<?php

namespace App\Http\Controllers\Api;
use Exception;
use App\Models\User;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiGestionUserController extends Controller
{
    //
    public function ProfilDesCandidat()
    {
        
            $candidats= User::where('role', 'candidat')->get();
            return response()->json($candidats, 200);
    }

    public function listeUser()
    {
        //
        try{
            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Les profession ont ete recuperé",
                "data"=>User::all()
            ]);
        }catch(Exception $e){

            response()->json($e);

        }
    }


    public function updateCandidat(Request $request)
    { 
        try{
        //
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required",
            "telephone"=>"required",
            "presentation"=>"required", 
            "langueParler"=>"required",
            "civilite"=>"required",
            "experienceProf"=>"required",
            "dateNaissance"=>"required",
            "lieu"=>"required",
            // "statut"=>"required",
            // "role"=>"required",
            "profession_id"=>"required"
         ]);
        
        
         auth()->user()->update([
            "nom" => $request->nom,
            "prenom"=> $request->prenom,
            "imageDeProfil"=>$request->file('imageDeProfil')->store('images/profil', 'public'),
            "telephone"=>$request->telephone,
            "presentation"=>$request->presentation,
            "langueParler"=>$request->langueParler,
            "civilite"=>$request->civilite,
            "experienceProf"=>$request->experienceProf,
            "dateNaissance"=>$request->dateNaissance,
            "lieu"=>$request->lieu,
            "profession_id"=>$request->profession_id,
            "password"=>$request->password, 
            
        ]);
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"Le profil a ete bien Modifié",
            // "data"=>$user
            ]);
        }catch(Exception $e){

         
       return response()->json($e);
        }
         
    }


    public function updateEmployeur(Request $request)
    { 
        try{
        //
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required",
            "telephone"=>"required",
            "lieu"=>"required",
            // "statut"=>"required",
            // "role"=>"required",
            // "profession_id"=>"required"
         ]);
        
        
         auth()->user()->update([
            "nom" => $request->nom,
            "prenom"=> $request->prenom,
            "imageDeProfil"=>$request->file('imageDeProfil')->store('images/profil', 'public'),
            "telephone"=>$request->telephone,
            "lieu"=>$request->lieu,
            "password"=>$request->password, 
            
        ]);
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"Le profil a ete bien Modifié",
            // "data"=>$user
            ]);
        }catch(Exception $e){

         
       return response()->json($e);
        }
         
    }

    public function updateAmin(Request $request)
    { 
        try{
        //
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required",
            "telephone"=>"required",
            "lieu"=>"required",
            // "statut"=>"required",
            // "role"=>"required",
            // "profession_id"=>"required"
         ]);
        
        
         auth()->user()->update([
            "nom" => $request->nom,
            "prenom"=> $request->prenom,
            "imageDeProfil"=>$request->file('imageDeProfil')->store('images/profil', 'public'),
            "telephone"=>$request->telephone,
            "lieu"=>$request->lieu,
            "password"=>$request->password, 
            
        ]);
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"Le profil a ete bien Modifié",
            // "data"=>$user
            ]);
        }catch(Exception $e){

         
       return response()->json($e);
        }
         
    }

    
    public function deactivateCompte($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['statut' => 'deactive']);

            return response()->json(['message' => 'Compte désactivé avec succès'], 200);

        }else {
            
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }


public function RecherOffreParUser(User $user)
{
    // Récupérer la catégorie en fonction de l'id
    $user = User ::where('id', $user->id)->first();

    if ($user) {
        // Récu$userpérer les annonces liées à la catégorie
        $OffreEmploi = OffreEmploi::where('user_id', $user->id)->get();

        return response()->json([
            "status_code"=>200,
            "data"=> $OffreEmploi,
        ]);
    } else {
        return response()->json([
            'statut' => 'Erreur',
            'message' => 'offre non trouver',
        ], 404);
    }
}


    public function listeCandidats()
    {
        try {
            // Utilise la méthode where pour filtrer par rôle
            $candidats = User::where('role', 'candidat')->get();

            return response()->json([
                "status_code" => 200,
                "status_messages" => "Liste des candidats récupérée avec succès",
                "data" => $candidats
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status_code" => 500,
                "status_messages" => "Erreur lors de la récupération de la liste des candidats",
                "error" => $e->getMessage()
            ]);
        }


}
}
