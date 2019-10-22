<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BensFormRequest extends FormRequest
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
             'nome'             => "required",
             'descricao'        => "required",
             'data_aquisicao'   => "required",
             'valor_unitario'   => "required",
             'qtde_bem'         => "required | integer",
         ];
     }

     public function messages()
     {
         return [
             'nome.required'           => "Digite o nome do bem!",
             'descricao.required'      => "Digite a descrição do bem!",
             'data_aquisicao.required' => "Digite a data de aquisição!",
             'valor_unitario.required' => "Digite o valor do bem!",
             'qtde_bem.required'       => "Digite a quantidade de bens!",
             'qtde_bem.integer'        => "A quantidade de bens deve ser um número inteiro!",
         ];
     }
 }