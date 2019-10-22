<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>
            SINPROSERMUCARU | Acesse sua conta
        </title>
        
        <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}"/>
        
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

        <link href="{{ asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
                <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="m-login__wrapper">
                                <div style="margin-top: -80px" class="m-login__logo">
                                    <img width="80" src="{{asset('assets/img/logomarca_sem_nome.png') }}">
                                </div>
                                <div class="m-login__signin">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Acesse Sua Conta
                                        </h3>
                                    </div>
                                    <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group m-form__group">
                                            <input type="email" id="email" name="email" class="form-control m-input" value="{{ old('email') }}" placeholder="Email" autofocus autocomplete="off">

                                            @if ($errors->has('email'))
                                                <div id="email-error" class="form-control-feedback" style="color: red">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input type="password" id="password" name="password" class="form-control m-input m-login__form-input--last" placeholder="Senha">

                                            @if ($errors->has('password'))
                                                <div id="password-error" class="form-control-feedback" style="color: red">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row m-login__form-sub">
                                            <div class="col m--align-left">
                                                <label class="m-checkbox m-checkbox--focus">
                                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Lembrar-me
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col m--align-right">
                                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                                    Esqueceu sua senha?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action">
                                            <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Entrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="m-login__forget-password">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Esqueceu sua senha?
                                        </h3>
                                        <div class="m-login__desc">
                                            Digite seu email para recuperar sua senha:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group m-form__group">
                                            <input type="email" id="email" name="email" class="form-control m-input" placeholder="Email" autocomplete="off" required>
                                        </div>
                                        <div class="m-login__form-action">
                                            <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Recuperar
                                            </button>
                                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="m-stack__item m-stack__item--center">
                            <div class="m-login__account">
                                <span class="m-login__account-msg">
                                    Desenvolvido por 
                                </span>
                                <a href="{{ url('https://buildsoft.com.br') }}" class="m-link m-link--focus m-login__account-link" target="_blank">
                                    BuildSoft Tecnologia
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content" style="background-image: url({{ asset('assets/app/media/img//bg/bg-1.jpg') }})">
                    <div class="m-grid__item m-grid__item--middle">
                        <h3 class="m-login__welcome">
                            SINPROSERMUCARU
                        </h3>
                        <p class="m-login__msg">
                            Sindicato dos Professores e Servidores Municipais de São João do Carú
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>
    </body>
</html>