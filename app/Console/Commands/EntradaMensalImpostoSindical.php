<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Entrada;

class EntradaMensalImpostoSindical extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrada-mensal-inposto-sindical:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera mensalmente a entrada referente aos impostos sindicais dos associados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            Entrada::geracaoEntradaMensal();

            \Mail::raw('Geração de entrada automática realizada com sucesso', function ($message) {
                $message->to('josivansousap@gmail.com')
                    ->subject('Geração de entrada automática SINPROSERMUCARU');
            });
        } catch (\Exception $e) {
            \Mail::raw('Erro ao gerar entrada automática. <br>'. $e, function ($message) {
                $message->to('josivansousap@gmail.com')
                    ->subject('Geração de entrada automática SINPROSERMUCARU');
            });
        }
    }
}
