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
                    'cargo'     => 'required', 
                    'edad'      => 'required', 
                    'tiempo'    => 'required',
                    'telefono'  => 'required', 
                    'tipo'      => 'required',
                    'nombre'    => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'cargo'     => 'required', 
                    'edad'      => 'required', 
                    'tiempo'    => 'required',
                    'telefono'  => 'required', 
                    'tipo'      => 'required',
                    'nombre'    => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'cargo.required'    => 'El campo :attribute es obligatorio.', 
            'edad.required'     => 'El campo :attribute es obligatorio.',
            'tiempo.required'   => 'El campo :attribute es obligatorio.', 
            'telefono.required' => 'El campo :attribute es obligatorio.', 
            'tipo.required'     => 'El campo :attribute es obligatorio.', 
            'nombre.required'   => 'El campo :attribute es obligatorio.', 
        ];
    }

    public function attributes(){
        return [
            'cargo'         => 'cédula', 
            'edad'          => 'edad',
            'tiempo'        => 'tiempo en la empresa', 
            'telefono'      => 'teléfono', 
            'tipo'          => 'tipo de constancia',
            'nombre'        => 'nombre'
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
