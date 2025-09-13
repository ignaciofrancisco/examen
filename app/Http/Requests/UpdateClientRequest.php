<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $clientId = $this->route('client');

        return [
            'rut_empresa' => ['required','string', Rule::unique('clients','rut_empresa')->ignore($clientId)],
            'rubro' => 'required|string',
            'razon_social' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string',
            'email_contacto' => 'required|email',
        ];
    }
}
