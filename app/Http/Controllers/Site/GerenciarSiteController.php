<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GerenciarSiteController extends Controller
{
    public function getGerenciarSite()
    {
        return view('configuracoes.site.cadastros_site');
    }
}
