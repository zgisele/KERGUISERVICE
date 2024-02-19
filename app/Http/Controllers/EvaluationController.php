<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvaluationRequest;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    // public function store(StoreEvaluationRequest $request)
    // {
    //     try{
                
    //             $user=auth()->user();
    //             $evaluation = new Evaluation();
    //             $evaluation->appreciation = $request->appreciation;
    //             $evaluation->user_id= $user->id;
    //             $evaluation->save();

    //             return response()->json([
    //             "status_code"=>200,
    //             "status_messages"=>"Commentaire ajouté avec succès",
    //             ]);
    //         }catch(Exception $e){
    //             return response()->json($e);
    //         }
        
    // }
    public function store(StoreEvaluationRequest $request ,$id)
    {
        try{
                $Candidat=User::findOrFail($id);
                $Employeur=auth()->user();
                $evaluation = new Evaluation();
                $evaluation->appreciation = $request->appreciation;
                $evaluation->employeur_id= $Employeur->id;
                $evaluation->candidat_id= $Candidat->id;
                $evaluation->save();

                return response()->json([
                "status_code"=>200,
                "status_messages"=>"Commentaire ajouté avec succès",
                "DonnésCommentaire"=>$evaluation,
                ]);
            }catch(Exception $e){
                return response()->json($e);
            }
        
    }

    /**
     * Display the specified resource.
     */
    // public function show()
    // {
    //     //
    //     $evaluationUsers= Evaluation::join('users', 'evaluations.user_id', '=', 'users.id')
    //         ->select('evaluations.appreciation',
    //         'users.nom',
    //         'users.prenom')
    //         ->get();
    //         return response()->json($evaluationUsers);
    // }

    public function showCandidat()
    {
        //
        $evaluationUsers= Evaluation::join('users', 'evaluations.employeur_id', '=', 'users.id')
            ->select('evaluations.appreciation',
            'users.nom',
            'users.prenom')
            ->get();
            return response()->json($evaluationUsers);
    }

    public function showEmployeur()
    {
        //
        $evaluationUsers= Evaluation::join('users', 'evaluations.candidat_id', '=', 'users.id')
            ->select('evaluations.appreciation',
            'users.nom',
            'users.prenom')
            ->get();
            return response()->json($evaluationUsers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
            try{    
                // $evaluation = Evaluation::findOrFail($id);
               
                $evaluation->delete();
    
                return response()->json([
                    "status_code"=>200,
                    "status_messages"=>"Le commentaire  a ete Supprimé",
                    "data"=>$evaluation
                    ]);
    
                }catch(Exception $e){
        
                return response()->json($e);
    
                }
    }   
}
