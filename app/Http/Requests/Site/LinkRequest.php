<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'link' => "required",
            'destino' => "required"
        ];
    }

    public function messages()
    {
        return [
           'destino.required' => "Digite o nome do link!",
           'link.required'    => "Digite o link!"
        ];
    }
}
