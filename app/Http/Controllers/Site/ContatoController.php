<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MensagemSiteFormRequest;
use App\Models\Site\Noticia;
use App\Repository\GenericRepository;
use App\Mail\EmailComentarioSite;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function getIndex()
    {
        return view('site.contato');
    }

    public function postEnviarMensagem(MensagemSiteFormRequest $request)
    {
        try {
            $email = $request->all();

            Mail::send('emails.mensagem_site', $email, function($message) use($email){
                $message->to($email['email'])->subject($email['assunto']);
                $message->from('contato@sinprosermucaru.com.br', $email['nome']);
            });
        } catch (\Exception $e) {
            return redirect()->back()->withError('Desculpe. Não foi possível enviar sua mensagem');
        }

        return redirect()->back()->withSuccess('Mensagem enviada com sucesso');
    }
}
