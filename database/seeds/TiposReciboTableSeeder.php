<?php

use Illuminate\Database\Seeder;
use App\Models\TipoRecibo;

class TiposReciboTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_recibo')->delete();

        TipoRecibo::create([
            'nome' 	    => 'Entrada',
            'descricao' => 'Recibo referente a entrada de valores'
        ]);

        TipoRecibo::create([
            'nome' => 'Saída',
            'descricao' => 'Recibo referente a saída de valores'
        ]);
    }
}
