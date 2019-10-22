<?php

use Illuminate\Database\Seeder;
use App\Models\GrauInstrucao;

class GrausInstrucaoTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('graus_instrucao')->delete();

        GrauInstrucao::create([
            'nome'  => 'Analfabeto',
            'descricao' => 'O associado é Analfabeto'
        ]);

        GrauInstrucao::create([
            'nome' => 'Ensino fundamental incompleto',
            'descricao' => 'Ensino fundamental incompleto'
        ]);

        GrauInstrucao::create([
            'nome'  => 'Ensino fundamental completo',
            'descricao' => 'Ensino fundamental completo'
        ]);

        GrauInstrucao::create([
            'nome' => 'Ensino médio incompleto',
            'descricao' => 'Ensino médio incompleto'
        ]);

        GrauInstrucao::create([
            'nome'  => 'Ensino médio completo',
            'descricao' => 'Ensino médio completo'
        ]);

        GrauInstrucao::create([
            'nome' => 'Superior completo',
            'descricao' => 'Superior completo'
        ]);
    }
}