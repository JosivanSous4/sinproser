<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmitirDocumentoFormRequest extends FormRequest
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
         return [
             'associado_id'  => "required",
             'documento_id'  => "required",
         ];
     }

     public function messages()
     {
         return [
             'associado_id.required'  => "Selecione o nome associado!",
             'documento_id.required'  => "Selecione o documento!",
         ];
     }
}
