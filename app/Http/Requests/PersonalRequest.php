<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE': { return []; }
            case 'POST': {
                return [
                    'cargo'         => 'required', 
                    'edad'          => 'required|integer', 
                    'nombre'        => 'required',
                    'cedula'        => 'required|integer|unique:personal',
                    'fechaIngreso'  => 'required',
                    'telefono'      => 'required|integer', 
                    'tipo'          => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'cargo'         => 'required', 
                    'edad'          => 'required|integer', 
                    'nombre'        => 'required',
                    'cedula'        => 'required|integer',
                    'fechaIngreso'  => 'required',
                    'telefono'      => 'required|integer', 
                    'tipo'          => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'cargo.required'        => 'El campo :attribute es obligatorio.', 
            'edad.required'         => 'El campo :attribute es obligatorio.',
            'fechaIngreso.required' => 'El campo :attribute es obligatorio.', 
            'telefono.required'     => 'El campo :attribute es obligatorio.', 
            'tipo.required'         => 'El campo :attribute es obligatorio.', 
            'nombre.required'       => 'El campo :attribute es obligatorio.', 
            'edad.integer'          => 'El campo :attribute solo debe contener números.',
            'cedula.integer'        => 'El campo :attribute solo debe contener números.',
            'telefono.integer'      => 'El campo :attribute solo debe contener números.'
        ];
    }

    public function attributes(){
        return [
            'cargo'         => 'cédula', 
            'edad'          => 'edad',
            'nombre'        => 'nombre',
            'cedula'        => 'cédula',
            'fechaIngreso'  => 'fecha de ingreso', 
            'telefono'      => 'teléfono', 
            'tipo'          => 'tipo de personal',
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
