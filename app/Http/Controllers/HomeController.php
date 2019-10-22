<?php

namespace App\Http\Controllers;

use App\Models\Associado;
use Illuminate\Http\Request;
use App\Repository\EntradaRepository;
use App\Repository\SaidaRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anoInicialSiga = 2019;
        $listaAnos = [];

        for ($ano = $anoInicialSiga; $ano <= date('Y'); $ano++) { 
            $listaAnos[] = $ano;
        }
        
        $dadosGraficoRendimento = (Object)[
            'entrada' => EntradaRepository::getDadosGraficoRendimento(),
            'saida' => SaidaRepository::getDadosGraficoRendimento()
        ];

        $dadosGraficoAdimplencia = EntradaRepository::getDadosGraficoAdimplencia();

        return view('home.home', compact('dadosGraficoRendimento', 'listaAnos', 'dadosGraficoAdimplencia'));
    }
}
