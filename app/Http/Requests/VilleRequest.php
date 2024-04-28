<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VilleRequest extends FormRequest
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
            'ref' => 'required|string|max:100',
            'villename' => 'required|string|max:100',
            'id_Z' => 'required|exists:zones,id_Z',
        ];
    }
}
