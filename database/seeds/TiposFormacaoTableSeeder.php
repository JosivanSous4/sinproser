<?php

use Illuminate\Database\Seeder;
use App\Models\TipoFormacao;

class TipoFormacaoTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_formacoes')->delete();

        TipoFormacao::create([
            'nome' 	=> 'Superior',
            'descricao' => 'Formação superior'
        ]);

        TipoFormacao::create([
            'nome' => 'Profissionalizante',
            'descricao' => 'Profissionalizante'
        ]);
    }
}