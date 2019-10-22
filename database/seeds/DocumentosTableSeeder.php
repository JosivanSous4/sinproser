<?php

use Illuminate\Database\Seeder;
use App\Models\Documento;

class DocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documentos')->delete();

        Documento::create([
        	'documento_id' 		 => '1',
            'nome' 				 => 'Recibo de Entrada',
            'template_documento' => '',
            'status_id' => 1,
            'usuario_id' => 1
        ]);

        Documento::create([
        	'documento_id' 		 => '2',
            'nome' 				 => 'Recibo de Saída',
            'template_documento' => '',
            'status_id' => 1,
            'usuario_id' => 1
        ]);
    }
}
