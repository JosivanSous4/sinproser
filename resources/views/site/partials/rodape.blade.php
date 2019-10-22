@php

    $siteController = new App\Http\Controllers\Site\SiteController();

    $maisPopulares = $siteController->getPostsPopulares();

    $i = 0;
    foreach ($maisPopulares as $maisPopular) {
        $i++;

        $maisPopular . $i = $maisPopular;
    }

    $acentos = array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/");

@endphp

<footer class="bg-191 color-ccc">

    <div class="container">
        <div class="pt-50 pb-20 pos-relative">
            <div class="abs-tblr pt-50 z--1 text-center">
                <div class="h-80 pos-relative">
                    <img class="opacty-1 h-100 w-auto" src="{{ asset('site/images/map.png') }}" alt="">
                </div>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="mb-30">
                        <a href="#">
                            <img src="{{ asset('assets/img/logo_site_footer.png') }}">
                        </a>
                        <p class="mtb-20 color-ccc">
                            Fundado em Data, o Sindicato dos Professores e Servidores Públicos de São João do Carú tem a missão de garantir a união entre seus colaboradores, criando uma força única de reivindicação de direitos e deveres do poder público para com os nossos associados.
                        </p>
                        <p class="color-ash">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Desenvolvido por <a href="https://buildsoft.com.br" target="_blank">BuildSoft Tecnologia</a>
                        </p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="mb-30">
                        <h5 class="color-primary mb-20"><b>MAIS POPULARES</b></h5>

                        @if(!empty($maisPopular1) || !empty($maisPopular2))
                            @if(!empty($maisPopular1))
                                <div class="mb-20">
                                    @php
                                        $tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $maisPopular1->titulo);
                                        $tituloMinus = strtolower($tituloSAcento);
                                        $tituloUrl = str_replace(' ', '-', $tituloMinus);
                                    @endphp
                                    <a class="color-white" href="{{ url('/noticias/'.$maisPopular->noticia_id.'/'.$tituloUrl) }}">
                                        <b>{{ $maisPopular1->titulo }}</b>
                                    </a>
                                    <h6 class="mt-10">{{ strftime('%A, %d de %B de %Y', strtotime($maisPopular1->created_at)) }}</h6>
                                </div>
                            @endif

                            <div class="brdr-ash-1 opacty-2 mr-30"></div>

                            @if(!empty($maisPopular2))
                                <div class="mt-20">
                                    @php
                                        $tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $maisPopular2->titulo);
                                        $tituloMinus = strtolower($tituloSAcento);
                                        $tituloUrl = str_replace(' ', '-', $tituloMinus);
                                    @endphp
                                    <a class="color-white" href="{{ url('/noticias/'.$maisPopular2->noticia_id.'/'.$tituloUrl) }}">
                                        <b>{{ $maisPopular2->titulo }}</b>
                                    </a>
                                    <h6 class="mt-10">{{ strftime('%A, %d de %B de %Y', strtotime($maisPopular2->created_at)) }}</h6>
                                </div>
                            @endif
                        @else
                            <div class="mt-20">
                                <a class="color-white" href="#">
                                    <b>Nenhum Post publicado</b>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="mb-30" style="padding-top: 45px">                        
                        @if(!empty($maisPopular3))
                            <div class="mb-20">
                                @php
                                    $tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $maisPopular3->titulo);
                                    $tituloMinus = strtolower($tituloSAcento);
                                    $tituloUrl = str_replace(' ', '-', $tituloMinus);
                                @endphp
                                <a class="color-white" href="{{ url('/noticias/'.$maisPopular3->noticia_id.'/'.$tituloUrl) }}">
                                    <b>{{ $maisPopular3->titulo }}</b>
                                </a>
                                <h6 class="mt-10">{{ strftime('%A, %d de %B de %Y', strtotime($maisPopular3->created_at)) }}</h6>
                            </div>
                        @endif

                        <div class="brdr-ash-1 opacty-2 mr-30"></div>

                        @if(!empty($maisPopular4))
                            <div class="mt-20">
                                @php
                                    $tituloSAcento = preg_replace($acentos, explode(" ","a A e E i I o O u U n N"), $maisPopular4->titulo);
                                    $tituloMinus = strtolower($tituloSAcento);
                                    $tituloUrl = str_replace(' ', '-', $tituloMinus);
                                @endphp
                                <a class="color-white" href="{{ url('/noticias/'.$maisPopular4->noticia_id.'/'.$tituloUrl) }}">
                                    <b>{{ $maisPopular4->titulo }}</b>
                                </a>
                                <h6 class="mt-10">{{ strftime('%A, %d de %B de %Y', strtotime($maisPopular4->created_at)) }}</h6>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="brdr-aaa-1 opacty-2"></div>

        <div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

            <ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
                <li><a class="pl-0 pl-sm-10" href="#"></a></li>
                <li><a href="{{ url('/institucional/diretoria') }}">Diretoria</a></li>
                <li><a href="{{ url('/links-uteis') }}">Links Úteis</a></li>
                <li><a href="{{ url('/contato') }}">Contato</a></li>
            </ul>

            <ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
                <li><a class="pl-0 pl-sm-10" href="#" title="Facebook"><i class="ion-social-facebook"></i></a></li>
                <li><a href="#" title="Twitter"><i class="ion-social-twitter"></i></a></li>
                <li><a href="#" title="Instagram"><i class="ion-social-instagram"></i></a></li>
                <li><a href="#"><i class="ion-social-google" title="Google"></i></a></li>
            </ul>

        </div>
    </div>
</footer>