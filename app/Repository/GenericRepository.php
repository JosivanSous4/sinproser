<?php

namespace App\Repository;

class GenericRepository
{
	public static function salvarVariosContatos($model, $contatos)
	{
        if($contatos) {
            $idsContatos = [];
            foreach ($contatos as $key => $contato) {
                $contato = (object)$contato;
                $idsContatos[] = $contato->contato_id? $contato->contato_id: '';
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

	public static function upload($file)
	{
        if($file){
            $storage_path = storage_path('app/public/uploads/');

            $nomeArquivo = uniqid(date('HisYmd'));
            $extencao = $file->getClientOriginalExtension();
            $nomeArquivo = "{$nomeArquivo}.{$extencao}";

            $file->move($storage_path, $nomeArquivo);

            return $nomeArquivo;
        }

        return '';
	}
}
