<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(DadosPessoaisTableSeeder::class);
        $this->call(GrausInstrucaoTableSeeder::class);
        $this->call(PerfisTableSeeder::class);
        $this->call(TipoFormacaoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AreasAtuacaoTableSeeder::class);
        $this->call(TiposEntradaTableSeeder::class);
        $this->call(TiposReciboTableSeeder::class);
        $this->call(TiposPagamentosTableSeeder::class);
        $this->call(DocumentosTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
    }
}
