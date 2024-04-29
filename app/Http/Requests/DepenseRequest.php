<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepenseRequest extends FormRequest
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
            'depense' => 'required|string',
            'description' => 'nullable|string',
            'montant' => 'required|integer',
            'datedep' => 'nullable|date',
            'id_U' => 'required|exists:users,id_U',
        ];
    }
}
