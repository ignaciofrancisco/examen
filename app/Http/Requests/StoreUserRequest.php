<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // controla permisos en policies/middleware si quieres
    }

    public function rules()
    {
        return [
            'rut' => 'required|string|unique:users,rut',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => ['required','email','unique:users,email','regex:/^[\w\.\-]+@ventasfix\.cl$/i'],
            'password' => 'required|string|min:8'
        ];
    }
}
