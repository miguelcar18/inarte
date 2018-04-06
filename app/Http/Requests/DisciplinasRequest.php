<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinasRequest extends FormRequest
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
                    'nombre' => 'required|unique:disciplinas'
                ];
            }
            case 'PUT': {
                return [
                    'nombre' => 'required', 
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'nombre.required'   => 'El campo :attribute es obligatorio.', 
            'nombre.unique'     => 'El :attribute ingresado ya ha sido registrado.', 
        ];
    }

    public function attributes(){
        return [
            'nombre' => 'nombre'
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
