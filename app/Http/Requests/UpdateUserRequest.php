<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user'); // ruta apiResource {user}

        return [
            'rut' => ['required','string', Rule::unique('users','rut')->ignore($userId)],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => ['required','email', Rule::unique('users','email')->ignore($userId), 'regex:/^[\w\.\-]+@ventasfix\.cl$/i'],
            'password' => 'nullable|string|min:8'
        ];
    }
}
