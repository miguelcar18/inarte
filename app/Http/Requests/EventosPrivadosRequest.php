<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventosPrivadosRequest extends FormRequest
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
                    'fecha'         => 'required', 
                    'lugar'         => 'required', 
                    'nombre'        => 'required',
                    'empresa'       => 'required',
                    'disciplina'    => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'fecha'         => 'required', 
                    'lugar'         => 'required', 
                    'nombre'        => 'required',
                    'empresa'       => 'required',
                    'disciplina'    => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'fecha.required'            => 'El campo :attribute es obligatorio.', 
            'lugar.required'            => 'El campo :attribute es obligatorio.',
            'nombre.required'           => 'El campo :attribute es obligatorio.', 
            'empresa.required'          => 'El campo :attribute es obligatorio.', 
            'disciplina.required'       => 'El campo :attribute es obligatorio.'  
        ];
    }

    public function attributes(){
        return [
            'fecha'         => 'fecha', 
            'lugar'         => 'lugar',
            'nombre'        => 'nombre', 
            'empresa'       => 'empresa', 
            'disciplina'    => 'disciplina'
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
