<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConstanciasRequest extends FormRequest
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
                    'personal'  => 'required', 
                    'dirigido'  => 'required', 
                    'tipo'      => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'personal'  => 'required', 
                    'dirigido'  => 'required', 
                    'tipo'      => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'personal.required' => 'El campo :attribute es obligatorio.', 
            'dirigido.required' => 'El campo :attribute es obligatorio.', 
            'tipo.required'     => 'El campo :attribute es obligatorio.', 
        ];
    }

    public function attributes(){
        return [
            'personal'      => 'personal', 
            'dirigido'      => 'persona dirigida',
            'tipo'          => 'tipo de constancia'
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
