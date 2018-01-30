<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursosRequest extends FormRequest
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
                    'curso'    => 'required', 
                    'lugar'    => 'required', 
                    'horario'  => 'required', 
                    'profesor' => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'curso'    => 'required', 
                    'lugar'    => 'required', 
                    'horario'  => 'required', 
                    'profesor' => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'curso.required'    => 'El campo :attribute es obligatorio.', 
            'lugar.required'    => 'El campo :attribute es obligatorio.',
            'horario.required'  => 'El campo :attribute es obligatorio.', 
            'profesor.required' => 'El campo :attribute es obligatorio.' 
        ];
    }

    public function attributes(){
        return [
            'curso'        => 'curso', 
            'lugar'        => 'lugar',
            'horario'      => 'horario',
            'profesor'     => 'profesor'
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
