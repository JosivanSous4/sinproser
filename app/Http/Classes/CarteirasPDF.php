<?php

namespace App\Http\Classes;

use \App\Http\Interfaces\HtmlToPdf;
use App\Models\Associado;
use App\Models\Carteira;
use App\Models\DadosPessoais;
use PDF;

class CarteirasPDF implements HtmlToPdf
{

    private $associados;
    private $nomeArquivo;

    public function __construct()
    {
    	set_time_limit (240);
        $this->prepare();
    }

    public function generatePdf()
    {
        $associados = $this->associados;
        
        return view('carteiras.carteiras-pdf', compact('associados'));
        // $pdf = PDF::loadView('carteiras.carteiras-pdf', compact('associados'))->save(storage_path('app/public/') . "pdf/".$this->nomeArquivo);
        // return $pdf->stream($this->nomeArquivo);
    }

    private function prepare()
    {
    	// dd("");
    	$this->associados = [];
        $associados = Associado::with('hasDadosPessoais', 'hasDadosFuncionais')->where('fk_id_status','1')->get();

        foreach ($associados as $key => $associado) {
        	$carteira = null;
	        $carteiraAntiga = Carteira::where('fk_id_associado', $associado->id)->first();
	        
	        $nomeArquivo = "carteira_" . str_replace(" ", "_", $associado->hasDadosPessoais->nome) . "_" . date("U") . ".pdf";
	        
	        if (isset($carteiraAntiga->id)) {
	            if($carteiraAntiga->update(['arquivo' => $nomeArquivo])) {
	                $carteira = Carteira::find($carteiraAntiga->id);
	            } else {
	                return view('carteira.carteiras')->with(["error","Não foi possível gerar a carteira"]);
	            }
	        } else {
	            $carteira = new Carteira();
	            $carteira->arquivo =  $nomeArquivo;
	            $carteira->fk_id_associado = $associado->id;
	            $carteira->id_hash = Auxiliar::gerarHash(rand(2, 4));
	            $carteira->data_emissao = date('Y-m-d H:i:s');
	            $carteira->save();
	        }
	        $associado->hasDadosPessoais->cpf = DadosPessoais::mascara($associado->hasDadosPessoais->cpf);

	        // PDF::loadView('carteiras.carteira-pdf', compact('associado','carteira'))->save(storage_path('app/public/') . "pdf/".$nomeArquivo);

	        $associado = (Object)[
	        	'associado'	=> $associado,
	        	'carteira' 	=> $carteira
	        ];
			$this->nomeArquivo = "carteiras_dos_associados_" . date("U") . ".pdf";
	        $this->associados[] = $associado;
        }
    }

}