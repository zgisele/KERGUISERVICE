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
            "nom"=>"required|max:30",
            "prenom"=>"required|max:30",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
            "telephone"=>["required", "regex:/^(70|75|76|77|78)[0-9]{7}$/"],
            "presentation"=>"required|max:255", 
            "langueParler"=>"required|max:30",
            "civilite"=>"required",
            "experienceProf"=>"required|integer|min:0",
            "dateNaissance"=>"required|date",
            "lieu"=>"required|max:30",
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
            "nom"=>"required|max:30",
            "prenom"=>"required|max:30",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
            "telephone"=>["required", "regex:/^(70|75|76|77|78)[0-9]{7}$/"],
            "lieu"=>"required|max:30",
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
            "nom"=>"required|max:30",
            "prenom"=>"required|max:30",
            "imageDeProfil"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            // "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
            "telephone"=>["required", "regex:/^(70|75|76|77|78)[0-9]{7}$/"],
            "lieu"=>"required|max:30",
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



    public function activateCompte($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['statut' => 'activer ']);

            return response()->json(['message' => 'Compte activé avec succès'], 200);

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
           $candidats = User::where('role', 'candidat')->with(['profession'])->get();
           
            return response()->json([
                "status_code" => 200,
                "status_messages" => "Liste des candidats récupérée avec succès",
                "data" => $candidats
            ]);
       


    }
}
