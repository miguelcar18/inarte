<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorariosRequest extends FormRequest
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
                    'profesor'   => 'required', 
                    'horario'    => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'profesor'   => 'required', 
                    'horario'    => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'profesor.required' => 'El campo :attribute es obligatorio.', 
            'horario.required'  => 'El campo :attribute es obligatorio.' 
        ];
    }

    public function attributes(){
        return [
            'profesor'  => 'profesor', 
            'horario'   => 'horario'
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
