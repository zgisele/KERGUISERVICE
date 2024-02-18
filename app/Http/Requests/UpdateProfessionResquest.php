<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfessionResquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "nom_prof"=>"required|max:30",
            "image"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            "description"=>"required|max:255"
        ];
    }
    
    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([

            'success'=>false,
            'error'=>true,
            'message'=>'Erreure de validation',
            'errorsListe'=> $validator->errors(),
        ]

        )); 
    }

    public function messages()
     {
        return [
            "nom_prof.required" => "Le champ nom_prof est requis.",
            "nom_prof.max" => "Le champ nom_prof ne doit pas dépasser 30 caractères.",
            "image.required" => "Le champ image est requis.",
            "image.mimes" => "L'image doit être au format JPEG, PNG, JPG ou AVIF.",
            "image.max" => "L'image ne doit pas dépasser 2048 kilo-octets.",
            "description.required" => "Le champ description est requis.",
            "description.max" => "Le champ description ne doit pas dépasser 30 caractères."
            
        ];
     }
}
