<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioFormRequest;
use App\Http\Requests\ResetSenhaRequest;
use App\Models\User;
use Validator;
// use App\Models\Status;
// use App\Models\AssociadoHasEntrada;
use App\Repository\UsuarioRepository;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('hasDadosPessoais', 'hasContatos', 'hasPerfil')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->get();

        return view('usuarios.listar_usuarios', compact('usuarios'));
    }

    public function form($id = "")
    {
        $usuario = ($id=="" ? new User() : User::with('hasDadosPessoais.hasAssociado' ,'hasPerfil' ,'hasContatos')->find($id));

        return view('usuarios.form_usuario', compact('usuario'));
    }

	public function salvar(Request $request)
    {
        $dadosRequest = $request->all();

        $rules = [
            'perfil_id'   => 'required',
            'dados_pessoais.nome'               => 'required',
            'dados_pessoais.sexo'               => 'required',
            'dados_pessoais.estado_civil'       => 'required',
            'dados_pessoais.cpf'                => 'required',
            'dados_pessoais.data_nascimento'    => 'required',
            'dados_pessoais.rg'                 => 'required',
            'dados_pessoais.data_emissao_rg'    => 'required',
            'dados_pessoais.orgao_emissor_rg'   => 'required',
        ];

        if (!isset($dadosRequest['user_id'])) {
            $rules += [
                'email'       => 'required|unique:users,email',
                'password'    => 'required|min:8|confirmed',
                'password_confirmation'   => 'required'
            ];
        }

        Validator::make($dadosRequest, $rules)->validate();

    	try {
            $salvar = UsuarioRepository::updateOrCreateOne($dadosRequest);
            if ($salvar['status'] == 1) {
                return [
                    'status'  => 'success',
                    'msg'     => $salvar['msg']
                ];
            }else{
                return [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $salvar['msg']
                ];
            }
       	} catch (\Exception $e) {
    		return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e
    		];
    	}
    }

    public function resetarSenha(ResetSenhaRequest $request)
    {
        try {
            $usuario = User::find($request->user_id);

            $usuario->password = bcrypt($request->password);
            $usuario->save();

            return [
                'status' => 'success',
                'msg'    => 'Senha salva com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
        }
    }

    public function verificarUsuario($email)
    {
        try {
            $usuario = User::where('email', $email)->count();

            return $usuario;
        } catch (\Exception $e) {
            return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
        }
    }

    public function desativarUser(Request $request)
    {
        try {
            $usuario = User::find($request->user_id);

            $usuario->deleted_at = date('Y-m-d H:i:s');
            $usuario->save();

            return [
                'status' => 'success',
                'msg'    => 'Usuário desativa com sucesso!'
            ];
        } catch (\Exception $e) {
            return [
    			'status'  => 'error',
				'msg'     => 'Erro ao processar! ' . $e->getMessage()
    		];
        }
    }

    public function getUsuarioLogado()
    {
        try {
            $usuarioLogado = [
                'user_id'   => \Auth::user()->user_id,
                'name'      => \Auth::user()->name,
                'email'     => \Auth::user()->email,
                'perfil_id' => \Auth::user()->perfil_id
            ];

            return response()->json(\Auth::user()->perfil_id,200);;
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'msg'     => 'Erro ao processar! ' . $e->getMessage()
                ], 200);
        }
    }
}
