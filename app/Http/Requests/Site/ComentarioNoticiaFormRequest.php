<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioNoticiaFormRequest extends FormRequest
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
            'noticia_id'  => 'exists:noticias,noticia_id',
            'nome'        => 'required',
            'email'       => 'required|email',
            'comentario'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'noticia_id.exists'      => 'Não foi possível identificar a publicação',
            'nome.required'          => 'Informe seu nome',
            'email.required'         => 'Informe seu email',
            'comentario.required'    => 'Informe o comentário',
        ];
    }
}
