<?php

use Illuminate\Database\Seeder;
use App\Models\DadosPessoais;

class DadosPessoaisTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfis')->delete();

        DadosPessoais::create([
            'nome' => 'Jesonilton', 
            'sexo' => 'Masculino', 
            'rg' => '234248924', 
            'data_emissao_rg' => '2018-02-10', 
            'orgao_emissor_rg' => 'SSP', 
            'cpf' => '60621194301', 
            'estado_civil' => 'Solteiro(a)', 
            'data_nascimento' => '1994-04-05'
        ]);
    }
}