<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOffreEmploiResquest extends FormRequest
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
            "typeContrat"=>"required|max:30",
            "lieu"=>"required|max:30",
            "description"=>"required|max:255",
            "experienceMinimum"=>"required|integer|min:0",
            "slaireMinimum"=>"required|numeric|min:0",
            "image"=>"required|mimes:jpeg,png,jpg,avif|max:2048",
            "dateline"=>"required|date",
            // "slaireMinimum"=>"required",
            "profession_id"=>"required", 
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
            "typeContrat.required" => "Le champ typeContrat est requis.",
            "typeContrat.max" => "Le champ typeContrat ne doit pas dépasser 30 caractères.",
            "lieu.required" => "Le champ lieu est requis.",
            "lieu.max" => "Le champ lieu ne doit pas dépasser 30 caractères.",
            "description.required" => "Le champ description est requis.",
            "description.max" => "Le champ description ne doit pas dépasser 255 caractères.",
            "experienceMinimum.required" => "L'expérience minimum est requise.",
            "experienceMinimum.integer" => "L'expérience minimum doit être un entier.",
            "experienceMinimum.min" => "L'expérience minimum doit être au moins :min.",
            "slaireMinimum.required" => "Le salaire minimum est requis.",
            "slaireMinimum.numeric" => "Le salaire minimum doit être numérique.",
            "slaireMinimum.min" => "Le salaire minimum doit être d'au moins :min.",
            "image.required" => "Une image est requise.",
            "image.mimes" => "Le format de l'image doit être jpeg, png, jpg, ou avif.",
            "image.max" => "La taille de l'image ne doit pas dépasser :max kilo-octets.",
            "dateline.required" => "La date limite est requise.",
            "dateline.date" => "La date limite doit être une date valide.",
            "profession_id.required" => "L'identifiant de la profession est requis."
        ];
     }
}
