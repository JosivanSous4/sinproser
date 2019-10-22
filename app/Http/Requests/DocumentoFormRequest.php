<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentoFormRequest extends FormRequest
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
             'nome'               => "required",
             'template_documento' => "required",
         ];
     }

     public function messages()
     {
         return [
             'nome.required'            => "Por favor, digite um nome para o documento!",
             'texto.template_documento' => "Por favor, crie um layout para o documento!",
         ];
     }
 }
