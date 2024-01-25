<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Candidature;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccepteCandidature;
use App\Notifications\RejetteCandidature;
use App\Http\Controllers\OffreEmploiController;
use PhpParser\Node\Stmt\ElseIf_;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $candidaturesUsers= Candidature::with('user')->get();
        // return response()->json($candidaturesUsers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$offre_emploi_id)
    {
        //
        try {
            // $request->validate([
            // "dateSoum"=>"required",
            // ]);
            $candidature = new Candidature();
            // $candidature->dateSoum = $request->dateSoum;
            $candidature->dateSoum = now();
            $candidature->user_id=auth()->user()->id;
            $candidature->offre_emploi_id=$offre_emploi_id;
            //  dd($candidature);
            $candidature->save();

            // dd('avant if');
            if($candidature->etatCan==="accepter"){
                // dd('dans if');
                $userMail= User::find(auth()->user()->id); // Remplacez ceci par votre propre logique pour récupérer l'employé
                $candidature = Candidature::find($candidature->id);
                // Récupérer l'offre d'emploi associée à la candidature
                $offreEmploi = OffreEmploi::find($candidature->offre_emploi_id);
                // Récupérer l'employeur associé à l'offre d'emploi
                $employeur = User::find($offreEmploi->user_id);
                $userMail->notify(new AccepteCandidature($userMail->prenom,$employeur->nom,$employeur->prenom,$employeur->email,$employeur->telephone));
            
            }elseif($candidature->etatCan==="rejeter"){
                // dd('dans else if');
                $userMail= User::find(auth()->user()->id);
                $userMail->notify(new RejetteCandidature($userMail->prenom));
            }
            // dd('dehor');

            // if($candidature->status="accepter"){
            //     $userMail=User::find($user->id);
            //     $userMail->notify(new AccepteCandidature());
            //     // $table->enum('etatCan',['attente','accepter','rejeter']);
            // }
            return response()->json([
                "status" => true,
                "message" => "Votre candidature a été enregistrer avec succes"
            ]);
        }catch(Exception $e){

            return response()->json($e);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidature $candidature)
    {
        //
        // $candidaturesUsers= Candidature::with('user')
        // ->select('candidatures.dateSoum', 'candidatures.etatCan', 'users.nom')
        // ->get();

        // $candidaturesUsers = Candidature::join('users', 'candidatures.user_id', '=', 'users.id')
        //     ->select('candidatures.dateSoum',
        //     'candidatures.etatCan',
        //     'users.nom',
        //     'users.prenom',
        //     'users.email',
        //     'users.telephone',
        //     'users.presentation',
        //     'users.langueParler',
        //     'users.civilite',
        //     'users.experienceProf',
        //     'users.lieu')
        //     ->get();



        $candidaturesUsers = Candidature::join('users', 'candidatures.user_id', '=', 'users.id')
            ->join('professions', 'users.profession_id', '=', 'professions.id')
            ->select(
                'candidatures.dateSoum',
                'candidatures.etatCan',
                'users.nom',
                'users.prenom',
                'users.email',
                'users.telephone',
                'users.presentation',
                'users.langueParler',
                'users.civilite',
                'users.experienceProf',
                'users.lieu',
                'professions.nom_prof'
                
            )
            ->get();

        
        return response()->json($candidaturesUsers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Candidature $candidature)
    {
        // $nouvelEtatCan = $request->input('nouvel_etatCan');

        // Récupérer les candidatures à mettre à jour

        $candidaturesUsers = Candidature::join('users', 'candidatures.user_id', '=', 'users.id')
            ->join('professions', 'users.profession_id', '=', 'professions.id')
            ->select(
                'candidatures.id',
                'candidatures.dateSoum',
                'candidatures.etatCan',
                'users.nom',
                'users.prenom',
                'users.email',
                'users.telephone',
                'users.presentation',
                'users.langueParler',
                'users.civilite',
                'users.experienceProf',
                'users.lieu',
                'professions.nom_prof'
            )
            ->get();

        // Mettre à jour les candidatures
        foreach ($candidaturesUsers as $candidatureUser) {
            // Vous pouvez accéder aux propriétés de la candidature et de l'utilisateur ici
            $candidature = Candidature::find($candidatureUser->id);
            // dd( $candidature);
            // Vérifier si la candidature existe
            if ($candidature) {
                // Mettre à jour les champs nécessaires
                // $candidature->dateSoum = 'Nouvelle Date'; // Remplacez par la nouvelle valeur
                $candidature->etatCan='attente'; // Remplacez par la nouvelle valeur
                dd( $candidature);
                // Sauvegarder les modifications
                $candidature->update();
            }
        }

        return response()->json(['message' => 'Candidatures mises à jour avec succès']);
    
    }

    // public function updateEtatCan(Request $request)
    // {
    // // Valider la requête si nécessaire
    //     $request->validate([
    //     // 'nouvel_etatCan' => 'required',
    //     'candidatures.etatCan' => 'required',
    //     ]);

    //     // Récupérer la nouvelle valeur pour etatCan depuis la requête
    //     $nouvelEtatCan = $request->input('candidatures.etatCan');
    //     dd($nouvelEtatCan );
    //     // Mettre à jour toutes les candidatures avec la nouvelle valeur etatCan
    //     Candidature::join('users', 'candidatures.user_id', '=', 'users.id')
    //         ->join('professions', 'users.profession_id', '=', 'professions.id')
    //         ->update(['candidatures.etatCan' => $nouvelEtatCan]);

    //     return response()->json(['message' => 'Candidatures mises à jour avec succès']);
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
    public function updateEtatCan(Request $request, Candidature $candidature)
    {
        try {
        
            // Valider la requête si nécessaire
            $request->validate([
                'etatCan' => 'required',
            ]);

            // Récupérer la nouvelle valeur pour etatCan depuis la requête
            $nouvelEtatCan = $request->input('etatCan');
            
            // Mettre à jour la candidature avec la nouvelle valeur etatCan
            $candidature->update(['etatCan' => $nouvelEtatCan]);

            if($candidature->etatCan==="accepter"){

                // dd('dans if');
                return response()->json(['message' => 'La Candidature a ete accepter']);
                $userMail= User::find(auth()->user()->id); // Remplacez ceci par votre propre logique pour récupérer l'employé
                $candidature = Candidature::find($candidature->id);
                // Récupérer l'offre d'emploi associée à la candidature
                $offreEmploi = OffreEmploi::find($candidature->offre_emploi_id);
                // Récupérer l'employeur associé à l'offre d'emploi
                $employeur = User::find($offreEmploi->user_id);
                $userMail->notify(new AccepteCandidature($userMail->prenom,$employeur->nom,$employeur->prenom,$employeur->email,$employeur->telephone));
            
            }elseif($candidature->etatCan==="rejeter"){
                // dd('dans else if');
                return response()->json(['message' => ' La Candidature a ete rejeter']);
                $userMail= User::find(auth()->user()->id);
                $userMail->notify(new RejetteCandidature($userMail->prenom));
                
            }
            return response()->json(['message' => 'Candidature mise à jour avec succès']);

        }catch(Exception $e){

            return response()->json($e);
        }
    }

    public function SupprimerCandidature(Candidature $candidature)
    {
        try{    
            // $profession = Profession::findOrFail($id);
           
            $candidature->delete();

            return response()->json([
                "status_code"=>200,
                "status_messages"=>"La candidature a ete Supprimé",
                "data"=>$candidature
                ]);

            }catch(Exception $e){
    
            return response()->json($e);

            }
    }
}
