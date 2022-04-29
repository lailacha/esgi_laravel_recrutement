<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Verify if the user is a recrutor

        return Auth::user()->hasRole('recruteur');
        ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:100',
            'identification' => 'required|string|max:30',
            'domaine_id' => 'required',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:60',
            'pays_id' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'code_postal' => 'required|string|max:32',
            'mail' => 'required|string|email|max:320',
            'description' => 'required|string|max:300',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
