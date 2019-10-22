<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserHasContato;
use App\Models\Recibo;
use App\Models\DadosPessoais;
use App\Models\Log;

class UsuarioRepository
{
    static public function updateOrCreateOne($request)
    {
        // dd($request);


  // "user_id" => null
  // "email" => "admin@admin.com"
  // "password" => "12345678"
  // "password2" => null
  // "dados_pessoais_id" => null
  // "associado_id" => 1
  // "perfil_id" => 1
  // "dados_pessoais" => array:11 [
  //   "dados_pessoais_id" => 2
  //   "nome" => "Jesonilton Pontes Rodrigues"
  //   "sexo" => "Maculino"
  //   "rg" => "23131565564646"
  //   "data_emissao_rg" => "2019-01-01"
  //   "orgao_emissor_rg" => "SSP"
  //   "cpf" => "60621194301"
  //   "estado_civil" => "Solteiro(a)"
  //   "data_nascimento" => "1995-01-01"
  //   "created_at" => "2019-02-03 21:42:02"
  //   "updated_at" => "2019-02-03 21:55:23"
  // ]
  // "contatos" => array:1 [
  //   0 => array:6 [
  //     "contato_id" => 4
  //     "tipo" => "Telefone Fixo"
  //     "contato" => "(56) 4654-5566"
  //     "created_at" => "2019-02-03 21:42:02"
  //     "updated_at" => "2019-02-03 21:42:02"
  //     "pivot" => array:2 [
  //       "associado_id" => 1
  //       "contato_id" => 4
  //     ]
  //   ]
  // ]
  // "password_confirmation" => "12345678"


        try {
            DB::transaction(function () use ($request){
                if (!$request['user_id'] == null) {
                    $verificaDadosPessoais = DadosPessoais::with('hasAssociado.hasContatos')
                        ->where('cpf', $request['dados_pessoais']['cpf'])
                        ->first();
                    /////////////////
                    $dadosPessoais = $verificaDadosPessoais;
                    if ($verificaDadosPessoais->hasAssociado) {
                        $request['associado_id'] = $verificaDadosPessoais->hasAssociado->associado_id;
                    }
                }else {
                    $dadosPessoais = DadosPessoais::updateOrCreate(['dados_pessoais_id' => $request['dados_pessoais']['dados_pessoais_id']], $request['dados_pessoais']);
                }

                $request['name'] = $dadosPessoais->nome;
                $request['dados_pessoais_id'] = $dadosPessoais->dados_pessoais_id;

                // Adiciona ou Atualiza USER
                if (!$request['user_id']) {
                    $request['password'] = bcrypt($request['password']);
                }

                $usuario = User::updateOrCreate(['user_id' => $request['user_id']], $request);

                // Se existir algum ASSOCIADO com o mesmo CPF
                // cadastro os contatos dele para o usuario
                if (isset($verificaDadosPessoais)) {
                    if (count($verificaDadosPessoais->hasAssociado->hasContatos) != 0) {
                        foreach ($verificaDadosPessoais->hasAssociado->hasContatos as $contato) {
                            $contatoUser = new UserHasContato();
                            $contatoUser->user_id    = $usuario->user_id;
                            $contatoUser->contato_id = $contato->contato_id;
                            $contatoUser->save();
                        }
                    }
                }else { // Se não, cadastra os novos
                    // foreach ($request['contatos'] as $contato) {
                    //     $contato = new Contato();
                    //     // $contato->
                    //     $contatoUser = new UserHasContato();
                    //     $contatoUser->user_id    = $usuario->user_id;
                    //     $contatoUser->contato_id = $contato->contato_id;
                    //     $contatoUser->save();
                    // }
                    self::salvarVariosContatos($usuario, $request['contatos']);
                }

                $dados = json_encode($request);

                if($request['user_id']){
                    Log::sucesso('Usuário', 'Josivan alterou dados de <b>' . $usuario->email . '-' . $usuario->hasDadosPessoais->cpf. '</b>', $dados, 1);
                } else {
                    Log::sucesso('Usuário', 'Josivan registrou <b>' . $usuario->email . '-' . $usuario->hasDadosPessoais->cpf. '</b> como usuario', $dados, 1);
                }

            });

            if($request['user_id']){
                $message = 'Editado com Sucesso!';
            } else {
                $message = 'Salvo com Sucesso!';
            }

            return ['status' => 1, 'msg' => $message];
        }  catch (\Exception $ex) {
            return ['status' => 0, 'msg' => 'Erro ao salvar' . ' ' . $ex];
        }
    }

    public static function salvarVariosContatos($model, $contatos)
    {
        // dd($contatos);
        if($contatos){

            $idsContatos = [];
            foreach ($contatos as $key => $contato) {
                $idsContatos[] = isset($contato->contato_id) ? $contato->contato_id : '';
            }

            $idsContatos = array_filter($idsContatos);
            $contatosR = [];
            if(count($idsContatos)){
                $contatosR = $model->hasContatos()->whereNotIn('contatos.contato_id' ,$idsContatos)->get();
            } else {
                $contatosR = $model->hasContatos()->get();
            }

            if(count($contatosR)){
                foreach ($contatosR as $key => $contato) {
                   $contato->pivot->delete();
                   $contato->delete();
                }
            }

            foreach ($contatos as $key => $contato) {
                $contato = (array)$contato;
                $model->hasContatos()
                                 ->updateOrCreate(['contatos.contato_id' => $contato['contato_id']], $contato);
            };
        }
    }

}
