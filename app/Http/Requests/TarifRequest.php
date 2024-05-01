<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarifRequest extends FormRequest
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
        // dd(request());
        return [
            'villeRamassage' => 'required|exists:villes,id_V',
            'ville' => 'required|exists:villes,id_V',
            'prixliv' => 'required|integer',
            'prixret' => 'required|integer',
            'prixref' => 'required|integer',
            'delailiv' => 'required|string|max:100',
        ];
    }
}
