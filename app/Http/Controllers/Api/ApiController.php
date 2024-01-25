<?php

namespace App\Http\Controllers\Api;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;





class ApiController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    //  Enregistrer (POST, formdata)
    public function register(Request $request){
        
        // validation des donnes
        $request->validate([
           "nom"=>"required",
           "prenom"=>"required",
           "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
        //    "email"=>"required|email|unique:users",
           "password"=>"required",
           "telephone"=>"required",
           "presentation"=>"required",
           "langueParler"=>"required",
           "civilite"=>"required",
           "experienceProf"=>"required",
           "dateNaissance"=>"required",
           "lieu"=>"required",
        //    "statut"=>"required",
        //    "role"=>"required",
           "profession_id"=>"required"
        ]);

        //  Model Utilisateur
        $imagePath = $request->file('imageDeProfil')->store('images/profil', 'public');

        $user= new User();
        $user->nom = $request->get('nom');
        $user->prenom= $request->get('prenom');
        $user->imageDeProfil=$imagePath;
        $user->email= $request->get('email');
        $user->password= $request->get('password');
        $user->telephone= $request->get('telephone');

        $user->presentation= $request->get('presentation');
        $user->langueParler= $request->get('langueParler');
        $user->civilite= $request->get('civilite');
        $user->experienceProf= $request->get('experienceProf');
        $user->dateNaissance= $request->get('dateNaissance');

        $user->lieu= $request->get('lieu');
        $user->profession_id= $request->get('profession_id');
       
        $user->save();
        
        // User::create([
        //     "nom" => $request->nom,
        //     "prenom" => $request->prenom,
        //     "imageDeProfil" =>$imagePath,
        //     "email" => $request->email,
        //     "password" => Hash::make($request->motDePasse),
        //     "telephone" => $request->telephone,

        //     "presentation" => $request->presentation,
        //     "langueParler" => $request->langueParler,
        //     "civilite" => $request->civilite,
        //     "experienceProf" => $request->experienceProf,
        //     "dateNaissance" => $request->dateNaissance,

        //     "lieu" => $request->lieu,
        //     // "statut" =>"activer",
        //     // "role" => "candidat",
        //     "profession_id" => $request->profession_id
            
        // ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "Utilisateur enregistrer avec succes"
        ]);
    }

    public function register_Employeur(Request $request){
        
        // validation des donnes
        $request->validate([
           "nom"=>"required",
           "prenom"=>"required",
           "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
           "email"=>"required|email|unique:users",
        //    "motDePasse"=>"required",
           "password"=>"required",
           "telephone"=>"required",
        //    "presentation"=>"required",
        //    "langueParler"=>"required",
        //    "civilite"=>"required",
        //    "experienceProf"=>"required",
        //    "dateNaissance"=>"required",
           "lieu"=>"required",
        //    "profession_id"=>"required"
        ]);

        // Model Utilisateur
        $imagePath = $request->file('imageDeProfil')->store('images/profil', 'public');

        $user= new User();
        $user->nom = $request->get('nom');
        $user->prenom= $request->get('prenom');
        $user->imageDeProfil=$imagePath;
        $user->email= $request->get('email');
        $user->password= $request->get('password');
        $user->telephone= $request->get('telephone');
        $user->lieu= $request->get('lieu');
        $user->role="employeur";
        $user->save();

        // Response
        return response()->json([
            "status" => true,
            "message" => "Utilisateur enregistrer avec succes"
        ]);
    }
    public function register_Admin(Request $request){
        
        // validation des donnes
        $request->validate([
           "nom"=>"required",
           "prenom"=>"required",
           "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
           "email"=>"required|email|unique:users",
        //    "motDePasse"=>"required",
           "password"=>"required",
           "telephone"=>"required",
        //    "presentation"=>"required",
        //    "langueParler"=>"required",
        //    "civilite"=>"required",
        //    "experienceProf"=>"required",
        //    "dateNaissance"=>"required",
           "lieu"=>"required",
        //    "profession_id"=>"required"
        ]);

        //  Model Utilisateur
        $imagePath = $request->file('imageDeProfil')->store('images/profil', 'public');

        $user= new User();
        $user->nom = $request->get('nom');
        $user->prenom= $request->get('prenom');
        $user->imageDeProfil=$imagePath;
        $user->email= $request->get('email');
        $user->password= $request->get('password');
        $user->telephone= $request->get('telephone');
        $user->lieu= $request->get('lieu');
        $user->role="admin";
        $user->save();

        // Response
        return response()->json([
            "status" => true,
            "message" => "Utilisateur enregistrer avec succes"
        ]);
    }




    //  Autentification de l'utilisateur (POST, formdata)
    public function login(Request $request){
        
        //  validation des donnes
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        //  dd($request);
        // JWTAuth
        
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        // dd($token);

        if(!empty($token)){

            return response()->json([
                "status" => true,
                "message" => "User logged in succcessfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }
    //  Profile Utilisateur (GET)
    public function profile(){

        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Donnes de Profile ",
            "data" => $userdata
        ]);
    } 
    //  generer une nouvelle valeur de jeton 
    public function refreshToken(){
        
        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "Access a un nouveau jeton",
            "token" => $newToken
        ]);
    }
     // Deconnexion de Utilisateur (GET)
     public function logout(){
        
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "Utilisateur deconnecter avec  succes"
        ]);
    }

    // public function updateCandidat(Request $request,User $user)
    // {
    //     //
    //     try{
    //     // $request->validate([
    //     //     "nom"=>"required",
    //     //    "prenom"=>"required",
    //     //    "imageDeProfil"=>"required|mimes:jpeg,png,jpg|max:2048",
    //     // //    "email"=>"required|email|unique:users",
    //     //    "password"=>"required",
    //     //    "telephone"=>"required",
    //     //    "presentation"=>"required",
    //     //    "langueParler"=>"required",
    //     //    "civilite"=>"required",
    //     //    "experienceProf"=>"required",
    //     //    "dateNaissance"=>"required",
    //     //    "lieu"=>"required",
    //     // //    "statut"=>"required",
    //     // //    "role"=>"required",
    //     //    "profession_id"=>"required"
            
    //     // ]);

       
    //     $imagePath = $request->file('imageDeProfil');
    //     // ->store('images/profil', 'public');
    //     // dd("Bonjour");
        

    //     // $user = User::findOrFail($id);
        
    //     // $user->nom = $request->get('nom');
    //     $user = Auth::user();
    //     $user->nom=$request->input('nom');
    //     dd($user);
    //     $user->nom = $request->nom;
    //     $user->prenom= $request->prenom;
    //     $user->imageDeProfil=$imagePath;
    //     // $user->email=$email;
    //     $request->merge(['email' => $user->email]);
    //     $user->password= $request->password;
    //     $user->telephone= $request->telephone;

    //     $user->presentation= $request->presentation;
    //     $user->langueParler= $request->langueParler;
    //     $user->civilite= $request->civilite;
    //     $user->experienceProf= $request->experienceProf;
    //     $user->dateNaissance= $request->dateNaissance;
    //     $user->lieu= $request->lieu;
    //     $user->profession_id= $request->profession_id;
        

    //     // $user->nom = $request->get('nom');
    //     // $user->prenom= $request->get('prenom');
    //     // $user->imageDeProfil=$imagePath;
    //     // // $user->email= $request->get('email');
    //     // $request->merge(['email' => $user->email]);
    //     // // $user->email=$userMail->email;
    //     // $user->password= $request->get('password');
    //     // $user->telephone= $request->get('telephone');

    //     // $user->presentation= $request->get('presentation');
    //     // $user->langueParler= $request->get('langueParler');
    //     // $user->civilite= $request->get('civilite');
    //     // $user->experienceProf= $request->get('experienceProf');
    //     // $user->dateNaissance= $request->get('dateNaissance');

    //     // $user->lieu= $request->get('lieu');
    //     // $user->profession_id= $request->get('profession_id');
    //     $user->update();
    //     return response()->json([
    //         "status_code"=>200,
    //         "status_messages"=>"La profession a ete Modifié",
    //         "data"=>$user
    //         ]);
    //     }catch(Exception $e){

         
    //    return response()->json($e);
    //     }
       
    
    // }

    








    
}
