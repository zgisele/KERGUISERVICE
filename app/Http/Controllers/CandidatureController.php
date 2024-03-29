<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Candidature;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use App\Mail\AccepteCandidature;
use App\Mail\RejetteCandidature;
use PhpParser\Node\Stmt\ElseIf_;
// use App\Notifications\AccepteCandidature;
// use App\Notifications\RejetteCandidature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\OffreEmploiController;
use App\Http\Requests\UpdateCandidatureResquest;

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
    public function AffichagelisteDesCanditatureRecuParEmployeur()
    {

        // Récupérer toutes les offres de l'employeur connecté
        $offreEmploi = OffreEmploi::where('user_id', auth()->user()->id)->get();
        $candidatures = Candidature::whereIn('offre_emploi_id',$offreEmploi->pluck('id'))
            ->join('users', 'candidatures.user_id', '=', 'users.id')
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
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"Liste candidature reçu par l'employeur",
            "data"=>$candidatures
            ]);
        
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($offre_emploi_id)
    {
        //
        try {
            $candidature = new Candidature();
            $candidature->dateSoum = now();
            $candidature->user_id=auth()->user()->id;
            $candidature->offre_emploi_id=$offre_emploi_id;
            $candidature->save();

            return response()->json([
                'status_code' => 200,
                'status_messages' => 'Candidatures enregistre avec succès',
                
            ]);

        }catch(Exception $e){

            return response()->json($e);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
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

            // dd($candidaturesUsers);
        return response()->json($candidaturesUsers );
    // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidature $candidature)
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
    public function updateEtatCan(UpdateCandidatureResquest $request, Candidature $candidature)
    {
        try {

            // Récupérer la nouvelle valeur pour etatCan depuis la requête
            $nouvelEtatCan = $request->input('etatCan');
            
            // Mettre à jour la candidature avec la nouvelle valeur etatCan
            $candidature->update(['etatCan' => $nouvelEtatCan]);
            // foreach ($candidatures as $candidature) {



                    if($candidature->etatCan==="accepter"){

                        // dd('dans if');
                        
                        // $userMail= User::find(auth()->user()->id); // Remplacez ceci par votre propre logique pour récupérer l'employé
                      
                        $candidature = Candidature::find($candidature->id);
                        // $candidat= User::find($candidature->user_id);
                        $candidat= User::where('id',$candidature->user_id)->first();
                        // Récupérer l'offre d'emploi associée à la candidature
                        $offreEmploi = OffreEmploi::find($candidature->offre_emploi_id);
                        // Récupérer l'employeur associé à l'offre d'emploi
                        // $employeur = User::find($offreEmploi->user_id);
                        $employeur = User::where('id',$offreEmploi->user_id)->first();
                        // $candidat->notify(new AccepteCandidature($candidat->prenom,$candidat->nom,$employeur->prenom,$employeur->nom,$employeur->email,$employeur->telephone));
                        $dateEmbauche=Carbon::now()->addWeek()->format('Y-m-d');
                        Mail::to($candidat->email)->send(new AccepteCandidature($candidat,$employeur,$dateEmbauche));
                        return response()->json(['message' => 'La Candidature a ete accepter']);
                    
                    }elseif($candidature->etatCan==="rejeter"){
                       
                        $candidature = Candidature::find($candidature->id);
                        $candidat= User::where('id',$candidature->user_id)->first();
                        // dd($candidat);
                        // $candidat->notify(new RejetteCandidature($candidat->prenom,$candidat->nom));
                        Mail::to($candidat->email)->send(new RejetteCandidature($candidat));
                        return response()->json(['message' => ' La Candidature a ete rejeter']);

                        
                        
                    }

                return response()->json(['message' => 'Candidature mise à jour avec succès']);

            // }
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

    public function ListeCandidatureDeChaqueCandidat()
    {
        // Récupérez l'utilisateur actuellement authentifié
        $utilisateur = Auth::id();
        $candidatures = Candidature::with(['offre_emplois' => function ($query)
        {  
            $query->with('user');
        },'offre_emplois.profession'])
        ->where('user_id', $utilisateur)
        ->get();
         return response()->json([
            'status_code' => 200,
            'status_messages' => 'Informations de candidature récupérées avec succès',
            'data' =>$candidatures,

        ]);
        
        
    }
          
}
