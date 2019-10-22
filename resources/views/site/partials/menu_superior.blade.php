<header>
    <div class="bg-191">
        <div class="container">
            <div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

                <ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
                    <li><a href="{{url('/')}}" class="pl-0 pl-sm-10" >Início</a></li>
                    <li><a href="{{url('/links-uteis')}}">Links Úteis</a></li>
                    <li><a href="{{url('/contato')}}">Contato</a></li>
                    <li><a href="{{url('https://siga.sinprosermucaru.com.br/login')}}" target="_blank">Acesso ao SIGA</a></li>
                </ul>
                
                <ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
                    <li><a class="pl-0 pl-sm-10" href="#" title="Facebook"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="#" title="Google"><i class="ion-social-google"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="ion-social-instagram"></i></a></li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">
        <a class="logo" href="{{url('/')}}"><img src="{{ asset('assets/img/logo_site.png') }}" alt="Logo"></a>

        <a class="right-area src-btn" href="#" >
            <i class="active src-icn ion-search"></i>
            <i class="close-icn ion-close"></i>
        </a>
        <div class="src-form">
            <form>
                <input type="text" placeholder="Faça sua busca aqui">
                <button type="submit"><i class="ion-search"></i></a></button>
            </form>
        </div>

        <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

        <ul class="main-menu" id="main-menu">
            <li><a href="{{url('/')}}">INÍCIO</a></li>
            <li><a href="{{url('/noticias')}}">NOTÍCIAS</a></li>
            <li><a href="{{url('/links-uteis')}}">LINKS ÚTEIS</a></li>
            <li class="drop-down">
                <a href="{{url('/institucional/quem-somos')}}">
                    INSTITUCIONAL <i class="ion-arrow-down-b"></i>
                </a>
                <ul class="drop-down-menu drop-down-inner">
                    <li>
                        <a href="{{url('/institucional/quem-somos')}}">QUEM SOMOS</a>
                    </li>
                    <li>
                        <a href="{{url('/institucional/diretoria')}}">DIRETORIA</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="clearfix"></div>
    
    </div>
    
</header>
