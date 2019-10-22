<?php

namespace App\Http\Controllers;

use App\Repository\AssociadoRepository;
use App\Http\Classes\CarteiraPDF;
use App\Models\Carteirinha;
use Illuminate\Http\Request;

class CarteirinhaController extends Controller
{

	use \App\Models\Traits\HtmlToPdfTrait;

    private $repoAssociado;

    public function __construct(AssociadoRepository $associadoRepository)
    {
        $this->repoAssociado = $associadoRepository;
    }

	public function getIndex(Request $request)
	{

		if(!$request->has('acao')){
			$acao = 'lapc';
		} else {
			$acao = $request->acao;
		}

		$associados = null;

		//listar associados que possuem carteirinha
		if($acao == 'lapc') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
		}

		//listar associados que não possuem carteirinha
		if($acao == 'lanpc') {
			$associados = $this->repoAssociado->getAssociadosSemCarteirinha();
		}

		//listar todas as cateirinhas não impressas
		if($acao == 'ltcni') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								if(!$associado->bol_carteinha_impressa){
									return $associado;
								}
							});
		}

		//listar todas as cateirinhas impressas
		if($acao == 'ltci') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								if($associado->bol_carteinha_impressa){
									return $associado;
								}
							});
		}

		//exibir toda as carteirinhas emitidas
		if($acao == 'extce') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								return $associado->associado_id;
							});

			return $this->toPdf(new CarteiraPDF($idsAssociados->toArray()));
		}

		//exibir todas as cateirinhas não impressas
		if($acao == 'extcni') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								if(!$associado->bol_carteinha_impressa){
									return $associado->associado_id;
								}
							});

			return $this->toPdf(new CarteiraPDF($idsAssociados->toArray(), true));
		}

		//exibir todas as cateirinhas impressas
		if($acao == 'extci') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								if($associado->bol_carteinha_impressa){
									return $associado->associado_id;
								}
							});

			return $this->toPdf(new CarteiraPDF($idsAssociados->toArray(), true));
		}

		//emitir carteirinha de associados que não possuem
		if($acao == 'emcanp') {
			$associados = $this->repoAssociado->getAssociadosSemCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								return $associado->associado_id;
							});

			return $this->toPdf(new CarteiraPDF($idsAssociados->toArray(), true));
		}

		//emitir segunda via de todas as carteirinha já emitidas
		if($acao == 'emsvtce') {
			$associados = $this->repoAssociado->getAssociadosComCarteirinha();
			$idsAssociados = $associados->map(function($associado){
								return $associado->associado_id;
							});

			return $this->toPdf(new CarteiraPDF($idsAssociados->toArray(), true));
		}

		$minRelatorio = (object)[
			'qtd_associados_com_carteirinha' =>  $this->repoAssociado->getAssociadosComCarteirinha()? $this->repoAssociado->getAssociadosComCarteirinha()->count(): 0,
			'qtd_associados_sem_carteirinha' =>  $this->repoAssociado->getAssociadosSemCarteirinha()? $this->repoAssociado->getAssociadosSemCarteirinha()->count() : 0,
			'qtd_carteirinhas_nao_impressas' => (new Carteirinha)->getQtdCarteirinhasNaoImpressas(),
			'qtd_carteirinhas_impressas' => (new Carteirinha)->getQtdCarteirinhasImpressas()
		];

		return view('carteirinha.index', compact('associados', 'acao', 'minRelatorio'));
	}

	public function getEmitirCarteirinha($associado_id)
	{
	    if(!$this->repoAssociado->existeAssociado($associado_id)){
	        return redirect()->back()->withErrors(['error' => 'Associado não encontrado']);
	    }

	    return $this->toPdf(new CarteiraPDF([$associado_id], true));
	}

    public function getCarteirinha($associado_id)
    {
        if(!$this->repoAssociado->existeAssociado($associado_id)){
            return redirect()->back()->withErrors(['error' => 'Associado não encontrado']);
        }

        return $this->toPdf(new CarteiraPDF([$associado_id]));
    }

    public function getMarcarComoImpresso($carteirinha_id)
    {
    	$cateirinha = Carteirinha::find($carteirinha_id);

        if(is_null($cateirinha)){
	        return [
                'status'    => 'error',
                'msg'       => 'Carteirinha não encontrada'
            ];
        }

        switch ($cateirinha->bol_impresso) {
        	case false:
        		$cateirinha->bol_impresso = true;
        		$msg = 'Marcado com sucesso';

        		break;
        	default:
        		$cateirinha->bol_impresso = false;
        		$msg = 'Desmarcado com sucesso';

        		break;
        }

        $cateirinha->save();

        return [
                'status'    => 'success',
                'msg'       => $msg
            ];
    }
}
