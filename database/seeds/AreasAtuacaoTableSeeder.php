<?php

use Illuminate\Database\Seeder;
use App\Models\AreaAtuacao;

class AreasAtuacaoTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_pagamento')->delete();

        AreaAtuacao::create([
            'nome'  => 'Saúde',
            'descricao' => 'Área da saúde',
            'dia_previsto_pagamento' => 10,
            'usuario_criador_id' => 1
        ]);

        AreaAtuacao::create([
            'nome' => 'Educação',
            'descricao' => 'Área da educação',
            'dia_previsto_pagamento' => 13,
            'usuario_criador_id' => 1
        ]);
    }
}