<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MensualidadesRequest extends FormRequest
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
                    'cedula'        => 'required', 
                    'nombre'        => 'required', 
                    'mes'           => 'required', 
                    'banco'         => 'required',
                    'comprobante'   => 'required|unique:mensualidades'
                ];
            }
            case 'PUT': {
                return [
                    'cedula'        => 'required', 
                    'nombre'        => 'required', 
                    'mes'           => 'required', 
                    'banco'         => 'required',
                    'comprobante'   => 'required|unique:mensualidades'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'cedula.required'       => 'El campo :attribute es obligatorio.', 
            'nombre.required'       => 'El campo :attribute es obligatorio.',
            'mes.required'          => 'El campo :attribute es obligatorio.', 
            'banco.required'        => 'El campo :attribute es obligatorio.', 
            'comprobante.required'  => 'El campo :attribute es obligatorio.', 
            'comprobante.unique'    => 'El :attribute ingresado ya ha sido registrado.', 
        ];
    }

    public function attributes(){
        return [
            'cedula'        => 'çédula', 
            'nombre'        => 'nombre y apellido',
            'mes'           => 'mes',
            'banco'         => 'banco', 
            'comprobante'   => 'comprobante'
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
