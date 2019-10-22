<?php

use Illuminate\Database\Seeder;
use App\Models\Perfil;

class PerfisTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfis')->delete();

        Perfil::create([
            'nome'  => 'administrador',
            'descricao' => 'administrador'
        ]);

        Perfil::create([
            'nome'  => 'usuário',
            'descricao' => 'usuário'
        ]);

        Perfil::create([
            'nome'  => 'associado',
            'descricao' => 'associado'
        ]);

    }
}
