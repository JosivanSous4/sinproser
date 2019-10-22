<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\TipoEntrada;
use App\Models\TipoSaida;
use App\Models\AreaAtuacao;
use App\Models\TipoFormacao;
use App\Models\LocalTrabalho;
use App\Models\Saida;
use App\Models\Entrada;
use App\Models\GrauInstrucao;
use App\Models\TipoPagamento;
use App\Models\User;
use App\Models\Perfil;
use App\Repository\AssociadoRepository;
use App\Repository\LocalTrabalhoRepository;
use App\Repository\AreaAtuacaoRepository;
use App\Repository\TipoFormacaoRepository;
use App\Repository\EmprestimoRepository;
use \DB;


class TutoriaisController extends Controller
{
    public function index()
    {
        return view('tutoriais.tutoriais');
    }
}
