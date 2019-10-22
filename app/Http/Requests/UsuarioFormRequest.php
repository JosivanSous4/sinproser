<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends CommonFormRequest
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
        $rules = [
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:8',
            'perfil_id'   => 'required'
        ];

        $rules += $this->getDadosPessoaisRules();
        $rules += $this->getContatoRules();

        return $rules;
    }

    public function messages()
    {

        $messages = [
            'email.required'        => 'Digite o e-mail!',
            'email.unique'          => 'Já existe um usuário cadastro com esse e-mail, por favo, insira outro e-mail.',
            'password.required'     => 'Digite uma senha!',
            'password.min'          => "A senha deve ter no mínimo 8 caracteres.",
            'perfil_id.required'    => 'Selecione o perfil do usuario!'
        ];

        $messages += $this->getDadosPessoaisMessages();
        $messages += $this->getContatoMessages();

        return $messages;
    }
}
