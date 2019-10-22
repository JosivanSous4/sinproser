<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

		<title>
			SINPROSERMUCARU | @yield('title')</title>
		</title>

	    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-4.1.1.min.css')}}" rel="stylesheet" type="text/css"/>
	    <link href="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/demo/demo3/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/css/build.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
		
		<link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}"/>

		<style type="text/css">
			.m-body .m-content {
			    padding: 20px 30px !important;
			}

			.m-subheader {
			    padding: 30px 30px 0 30px !important;
			}

			.dataTables_filter label input {
				border-radius: 10px;
			}

			.clickable {
				cursor: pointer;
			}

			.hidden {
				color: transparent;
				border-color: transparent;
				position: absolute;
			}

			.error {
				width: 100%;
			    margin-top: .25rem;
			    font-size: 80%;
			    color: #f4516c;
			}
		</style>

	    @yield('css')

	    <script type="text/javascript">
	        var urlBase = "{{ url('/') }}";
	        var urlAtual = window.location.href;
	    </script>

	</head>
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >
		<div class="m-grid m-grid--hor m-grid--root m-page">

			@include('partials.menu-superior')

			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>

				@include('partials.menu-lateral')

				<div class="m-grid__item m-grid__item--fluid m-wrapper" id="app" v-cloak>

					@yield('content')

				</div>
			</div>

			<footer class="m-grid__item m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2019 &copy; SIGA by
								<a href="https://buildsoft.com.br" class="m-link">
									BuildSoft Tecnologia
								</a>
							</span>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

	    <script src="{{asset('assets/global/plugins/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/popper.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap-4.1.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/demo/demo3/base/scripts.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
	    <script src="{{asset('assets/global/plugins/webfont.js')}}" type="text/javascript"></script>
	    <script src="{{asset('assets/global/plugins/jquery.dataTables.min.js')}}" type="text/javascript"></script>
	    <script src="{{asset('assets/global/plugins/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/js/build.js')}}" type="text/javascript"></script>

		<script>

			WebFont.load({
				google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
				active: function() {
				    sessionStorage.fonts = true;
				}
			});

          	$(document).ready(function() {
			    $('.siga-data-table').DataTable({
			    	"language": {
					    "sEmptyTable": "Nenhum registro encontrado",
					    "sInfo": "Exibindo de _START_ até _END_ de _TOTAL_ registros",
					    "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
					    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
					    "sInfoPostFix": "",
					    "sInfoThousands": ".",
					    "sLengthMenu": "Exibindo _MENU_ por página",
					    "sLoadingRecords": "Carregando...",
					    "sProcessing": "Processando...",
					    "sZeroRecords": "Nenhum registro encontrado",
					    "sSearch": "Pesquisar",
					    "oPaginate": {
					        "sNext": "Próximo",
					        "sPrevious": "Anterior",
					        "sFirst": "Primeiro",
					        "sLast": "Último"
					    },
					    "oAria": {
					        "sSortAscending": ": Ordenar colunas de forma ascendente",
					        "sSortDescending": ": Ordenar colunas de forma descendente"
					    }
					}
				});
			});

          	var prefixo = window.location.pathname.substr(1).split("/");

			$('.js_principal').removeClass('m-menu__item--active');
          	if(prefixo[0].length > 0) {
          		$('#js_' + prefixo[0]).addClass('m-menu__item--active');
			} else {
			  $('#js_inicio').addClass('m-menu__item--active');
			}

          	$('.js_principal').click(function() {
          		$('.js_principal').removeClass('m-menu__item--active');
          		$(this).addClass('m-menu__item--active');
          	});
		</script>

		@yield('script-inferior')

	</body>
</html>
