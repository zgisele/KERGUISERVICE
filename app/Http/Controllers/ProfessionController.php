<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Profession;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function liste()
    {
        //
        try{
            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Les profession ont ete recuperé",
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation des donnes
        $request->validate([
            "nom_prof"=>"required",
            "image"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            "description"=>"required"
        ]);
        $profession= new Profession();
        $profession->nom_prof = $request->get('nom_prof');
        $profession->image = $request->file('image')->store('images/profil', 'public');
        $profession->description = $request->get('description');
        $profession->save();

        // Response
        return response()->json([
            "status" => true,
            "message" => "Profession enregistrer avec succes"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profession $profession)
    {
        //
        try{
        $request->validate([
            "nom_prof"=>"required",
            "image"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            "description"=>"required"
        ]);
       
        // $profession->nom_prof = $request->nom_prof;
        // $profession->description = $request->description;
        $profession->update([
            "nom_prof" => $request->nom_prof,
            "image" => $request->file('image')->store('images/profil', 'public'),
            "description" => $request->description,
        ]);
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"La profession a ete Modifié",
            "data"=>$profession
            ]);
        }catch(Exception $e){

         
       return response()->json($e);
        }
       
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try{    
            $profession = Profession::findOrFail($id);
           
            $profession->delete();

            return response()->json([
                "status_code"=>200,
                "status_messages"=>"La profession  a ete Supprimé",
                "data"=>$profession
                ]);

            }catch(Exception $e){
    
            return response()->json($e);

            }
    }




    public function RecherUserParProfession(Profession  $profession)
    {
        // Récupérer la catégorie en fonction de l'id
        $profession = Profession::where('id', $profession->id)->first();

        if ($profession) {
            // Récupérer les annonces liées à la catégorie
            $user = User::where('profession_id', $profession->id)->get();

            return response()->json([
                "status_code"=>200,
                "data"=> $user,
            ]);
        } else {
            return response()->json([
                'statut' => 'Erreur',
                'message' => 'User non trouvée',
            ], 404);
        }
    }

    public function RecherOffreEmploiParProfession(Profession  $profession)
    {
        // Récupérer la catégorie en fonction de l'id
        $profession=  Profession::where('id',  $profession->id)->first();

        if ( $profession) {
            // Récupérer les annonces liées à la catégorie
            $OffreEmploi = OffreEmploi::where('profession_id',$profession->id)->get();

            return response()->json([
                "status_code"=>200,
                "data"=> $OffreEmploi,
            ]);
        } else {
            return response()->json([
                'statut' => 'Erreur',
                'message' => 'User non trouvée',
            ], 404);
        }
    }



    
}
