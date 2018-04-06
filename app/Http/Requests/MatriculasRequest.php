<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        switch($this->method()){
            case 'GET':
            case 'DELETE': { return []; }
            case 'POST': {
                return [
                    'cedula'            => 'unique:matriculas', 
                    'nombre'            => 'required', 
                    'fechaNacimiento'   => 'required',
                    'disciplina'        => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'nombre'            => 'required', 
                    'fechaNacimiento'   => 'required',
                    'disciplina'        => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'cedula.required'           => 'El campo :attribute es obligatorio.', 
            'nombre.required'           => 'El campo :attribute es obligatorio.',
            'fechaNacimiento.required'  => 'El campo :attribute es obligatorio.', 
            'disciplina.required'       => 'El campo :attribute es obligatorio.', 
            'cedula.integer'            => 'El campo :attribute solo debe contener números.', 
            'cedula.unique'             => 'El :attribute ingresado ya ha sido registrado.', 
        ];
    }

    public function attributes(){
        return [
            'cedula'            => 'cedula', 
            'nombre'            => 'nombre y apellido',
            'fechaNacimiento'   => 'fecha de nacimiento', 
            'disciplina'        => 'disciplina'
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
}
