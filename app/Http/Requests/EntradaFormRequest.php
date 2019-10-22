<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaFormRequest extends FormRequest
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

     public function rules()
     {
         return [
             'competencia'           => 'required',
             'valor'                 => 'required',
             'tipo_entrada_id'       => 'required',
             'status_id'             => 'required'
         ];
     }

     public function messages()
     {
         return [
            'valor.required'             => "Digite o valor da entrada",
            'tipo_entrada_id.required'   => "Selecione o tipo de entrada",
            'competencia.required'       => "Selecione o mês referente a entrada",
            'status_id.required'         => "Selecione o status da entrada ",
         ];
     }
}
