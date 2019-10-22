<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->delete();

        Status::create([
            'status_id' => '1',
            'status' 	=> 'Ativo',
            'descricao' => 'Utilizado para informar que o registro está em uso no sistema'
        ]);

        Status::create([
            'status_id' => '2',
            'status' => 'Inativo',
            'descricao' => 'Utilizado para informar que o registro está utilizado no sistema'
        ]);

        Status::create([
            'status_id' => '3',
            'status' => 'Aberto',
            'descricao' => 'Referência a entrada não paga'
        ]);

        Status::create([
            'status_id' => '4',
            'status' => 'Pago',
            'descricao' => 'Referência a entrada quitada'
        ]);

        Status::create([
            'status_id' => '5',
            'status' => 'Disponivel',
            'descricao' => 'Referência a um bem disponivel'
        ]);

        Status::create([
            'status_id' => '6',
            'status' => 'Indisponível',
            'descricao' => 'Referência a um bem emprestado'
        ]);

        Status::create([
            'status_id' => '7',
            'status' => 'Removido',
            'descricao' => 'Referencia a um bem depreciado'
        ]);
    }
}
