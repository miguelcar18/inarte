<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /*public function rules(){
        return [
            'username'  => 'required|unique:usuarios', 
            'name'      => 'required',
            'email'     => 'required|unique:usuarios', 
            'password'  => 'required|min:6', 
            'rol'       => 'required'
        ];
    }*/

    public function messages(){
        return [
            'username.required'  => 'El campo :attribute es obligatorio.', 
            'name.required'      => 'El campo :attribute es obligatorio.',
            'email.required'     => 'El campo :attribute es obligatorio.', 
            'password.required'  => 'El campo :attribute es obligatorio.', 
            'rol.required'       => 'El campo :attribute es obligatorio.',
            'username.unique'    => 'El :attribute ingresado ya ha sido registrado.', 
            'email.unique'       => 'El :attribute ingresado ya ha sido registrado.', 
            'password.min'       => 'La cantidad mínima de caracteres para la :attribute es 6.', 
        ];
    }

    public function attributes(){
        return [
            'username'  => 'nombre de usuario', 
            'name'      => 'nombre y apellido',
            'email'     => 'email', 
            'password'  => 'contraseña', 
            'rol'       => 'rol'
        ];
    }

    public function response(array $errors){
        if ($this->expectsJson()){
            return response()->json([
                'validations'   => false, 
                'errors'        => $errors
            ]);
        }

        return $this->redirector->to($this->getRedirectUrl())
        ->withInput($this->except($this->dontFlash))
        ->withErrors($errors, $this->errorBag);
    }

    public function rules(){
        switch($this->method())
        {
            case 'GET':
            case 'DELETE': { return []; }
            case 'POST': {
                return [
                    'username'  => 'required|unique:usuarios', 
                    'name'      => 'required',
                    'email'     => 'required|unique:usuarios', 
                    'password'  => 'required|min:6', 
                    'rol'       => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'username'  => 'required', 
                    'name'      => 'required',
                    'email'     => 'required', 
                    'rol'       => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }
}
