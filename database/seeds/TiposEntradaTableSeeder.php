<?php

use Illuminate\Database\Seeder;
use App\Models\TipoEntrada;

class TiposEntradaTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_entrada')->delete();

        TipoEntrada::create([
            'nome' 	    => 'Imposto Sindical',
            'descricao' => 'Entrada de imposto sindical'
        ]);
    }
}
