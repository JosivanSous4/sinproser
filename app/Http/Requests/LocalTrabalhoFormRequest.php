<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalTrabalhoFormRequest extends CommonFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $rules = [
            'nome' => 'required',
        ];

        $rules += $this->getEnderecoRules();
        // $rules += $this->getContatoRules();
        
        return $rules;
    }
    
    public function messages()
    {
        $messages = [
            'nome.required'      =>  'Por favor, digite o nome do local de trabalho!',
        ];
        
        $messages += $this->getEnderecoMessages();
        // $messages += $this->getContatoMessages();

        return $messages;
    }
}
