<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCandidatureResquest extends FormRequest
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
            'etatCan' => 'required',
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
            "etatCan.required" => "Le champ etat Candidature est requis.",
            
        ];
     }
}
