<?php

use Illuminate\Database\Seeder;
use App\Models\TipoPagamento;

class TiposPagamentosTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_pagamento')->delete();

        TipoPagamento::create([
            'nome'  => 'Presencial',
            'descricao' => 'Presencial'
        ]);

        TipoPagamento::create([
            'nome' => 'Desconto na folha de pagamento',
            'descricao' => 'Desconto na folha de pagamento'
        ]);
    }
}
