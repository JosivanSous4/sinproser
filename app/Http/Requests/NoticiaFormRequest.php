<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaFormRequest extends FormRequest
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
            'titulo'            => 'required',
            'imagem_capa'       => 'required',
            'conteudo'          => 'required',
            'descricao_rapida'  => 'required',
            'bol_comunicado'    => 'required',
            'bol_destaque'      => 'required',
            'bol_ativo'         => 'required'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'              => 'Por favor, informe o título da notícia!',
            'imagem_capa.required'         => 'Por favor, adicione a foto de capa da notícia!',
            'conteudo.required'            => 'Por favor, informe o conteúdo da notícia!',
            'descricao_rapida.required'    => 'Por favor, crie um resumo para esta notícia!',
            'bol_comunicado.required'      => 'Por favor, selecione se a publicação é um comunicado!',
            'bol_destaque.required'        => 'Por favor, selecione se a publicação é um destaque!',
            'bol_ativo.required'           => 'Por favor, selecione se quer publicar a notícia ou não!'
        ];
    }
}
