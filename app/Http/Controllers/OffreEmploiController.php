<?php

namespace App\Http\Controllers;

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
        //
        try{
            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Liste des offres d'emploi",
                "data"=>Profession::all()
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
}
