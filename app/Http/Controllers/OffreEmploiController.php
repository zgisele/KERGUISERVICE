<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Exception;
use App\Models\User;
use App\Models\Profession;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;

class OffreEmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function liste()
    {    
        try{
            
            $offresEmplois = OffreEmploi::with(['user', 'profession'])->get();

            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Liste des offres d'emploi",
                "data"=>$offresEmplois
              
            ]);
        }catch(Exception $e){

            response()->json($e);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        try {
            $request->validate([
            "typeContrat"=>"required",
            "lieu"=>"required",
            "description"=>"required",
            "experienceMinimum"=>"required",
            "slaireMinimum"=>"required",
            // "slaireMinimum"=>"required",
            "profession_id"=>"required",
            ]);
            $user=User::find(auth()->user()->id);
            $OffreEmploi = new OffreEmploi();
            $OffreEmploi->typeContrat = $request->typeContrat;
            $OffreEmploi->lieu=$request->lieu;
            $OffreEmploi->description= $request->description;
            $OffreEmploi->experienceMinimum = $request->experienceMinimum;
            $OffreEmploi->slaireMinimum= $request->slaireMinimum;
            // $OffreEmploi->etat= $request->get('etat');
             $OffreEmploi->user_id = $user->id;
            $OffreEmploi->profession_id = $request->profession_id;
            $OffreEmploi->save();
            return response()->json([
                "status" => true,
                "message" => "Offre d'emploi enregistrer avec succes"
            ]);
        }catch(Exception $e){

            return response()->json($e);
            }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(OffreEmploi $offreEmploi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffreEmploi $offreEmploi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffreEmploi $OffreEmploi)
    {
        try {
            $request->validate([
            "typeContrat"=>"required",
            "lieu"=>"required",
            "description"=>"required",
            "experienceMinimum"=>"required",
            "slaireMinimum"=>"required",
            // "slaireMinimum"=>"required",
            "profession_id"=>"required",
            ]);

            $user=User::find(auth()->user()->id);
            $OffreEmploi->typeContrat = $request->typeContrat;
            $OffreEmploi->lieu=$request->lieu;
            $OffreEmploi->description= $request->description;
            $OffreEmploi->experienceMinimum = $request->experienceMinimum;
            $OffreEmploi->slaireMinimum= $request->slaireMinimum;
            $OffreEmploi->user_id = $user->id;
            $OffreEmploi->profession_id = $request->profession_id;
            $OffreEmploi->update();
            return response()->json([
                "status" => true,
                "message" => "l'Offre d'emploi a ete modifier  avec succes"
            ]);
        }catch(Exception $e){

            return response()->json($e);
            }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffreEmploi $OffreEmploi)
    {
        //
        try{    
           
           
            $OffreEmploi->delete();

            return response()->json([
                "status_code"=>200,
                "status_messages"=>"L'offre  a ete Supprimé",
                "data"=>$OffreEmploi
                ]);

            }catch(Exception $e){
    
            return response()->json($e);

            }
    }

    public function RecherCandidatureParOffre(OffreEmploi $OffreEmploi)
    {
        // Récupérer la catégorie en fonction de l'id
        $OffreEmploi = OffreEmploi::where('id', $OffreEmploi->id)->first();

        if ($OffreEmploi) {
            // Récupérer les annonces liées à la catégorie
            $candidature = Candidature::where('offre_emploi_id', $OffreEmploi->id)->get();

            return response()->json([
                "status_code"=>200,
                "data"=> $candidature,
            ]);
        } else {
            return response()->json([
                'statut' => 'Erreur',
                'message' => 'User non trouvée',
            ], 404);
        }
    }

    
    public function archiver(OffreEmploi $offreEmploi)
    {
        try {
            // Vérifie si l'offre d'emploi n'est pas déjà archivée
            if ($offreEmploi->etat !== 'archiver') {
                // Met à jour l'état de l'offre d'emploi à "archiver"
                $offreEmploi->update(['etat' => 'archiver']);

                return response()->json([
                    "status_code" => 200,
                    "status_messages" => "L'offre d'emploi a été archivée avec succès",
                    "data" => $offreEmploi
                ]);
            } else {
                return response()->json([
                    "status_code" => 200,
                    "status_messages" => "L'offre d'emploi est déjà archivée",
                    "data" => $offreEmploi
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status_code" => 500,
                "status_messages" => "Erreur lors de l'archivage de l'offre d'emploi",
                "error" => $e->getMessage()
            ]);
        }
    }
}
