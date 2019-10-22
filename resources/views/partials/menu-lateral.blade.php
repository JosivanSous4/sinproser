<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<div id="m_ver_menu"  class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown"  data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " style="padding: 0px 0 30px 0 !important;">
			@if(Auth::user()->perfil_id != 3)
			<li class="m-menu__item js_principal" id="js_inicio" aria-haspopup="true" >
				<a href="{{url('/')}}" class="m-menu__link">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-imac"></i>
					<span class="m-menu__link-text">
						Início
					</span>
				</a>
			</li>
			@endif
			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_associados" aria-haspopup="true"  m-menu-submenu-toggle="hover">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-users"></i>
					<span class="m-menu__link-text">
						Associados
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Associados
								</span>
							</span>
						</li>
						<li class="m-menu__item" aria-haspopup="true" >
							<a href="{{url('/associados/cadastro-de-associado')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cadastrar Associados
								</span>
							</a>
						</li>
						@if(Auth::user()->perfil_id != 3)
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/associados/lista-de-associados')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listar associados
								</span>
							</a>
						</li>

						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/associados/carteirinhas')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Carteirinhas
								</span>
							</a>
						</li>
						@endif
					</ul>
				</div>
			</li>
			@if(Auth::user()->perfil_id != 3)
			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_financeiro" aria-haspopup="true"  m-menu-submenu-toggle="hover">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-analytics"></i>
					<span class="m-menu__link-text">
						Financeiro
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/financeiro/entrada')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Entrada
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/financeiro/saida')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Saida
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_documentos" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-file"></i>
					<span class="m-menu__link-text">
						Documentos
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Documentos
								</span>
							</span>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/documentos/criar-documento')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Criar Documento
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/documentos/emitir-documento')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Emitir Documento
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/documentos')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listar Documentos
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_bens" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-truck"></i>
					<span class="m-menu__link-text">
						Bens
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Bens
								</span>
							</span>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/bens/cadastro-de-bens')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cadastrar Bem
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/bens')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listar Bens
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/bens/emprestimos')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Empréstimo de Bens
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_usuarios" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-user-settings"></i>
					<span class="m-menu__link-text">
						Usuários
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Usuários
								</span>
							</span>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/usuarios/form-usuario')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cadastrar Usuários
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{url('/usuarios')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listar Usuários
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu js_principal" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-diagram"></i>
					<span class="m-menu__link-text">
						Relatório
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Usuários
								</span>
							</span>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a href="{{url('/relatorio/financeiro/entrada')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Entrada
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a href="{{url('/relatorio/financeiro/saida')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Saída
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>

			<li class="m-menu__item  m-menu__item--submenu js_principal" id="js_configuracoes" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a  href="javascript:;" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-settings"></i>
					<span class="m-menu__link-text">
						Configurações
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
							<span class="m-menu__link">
								<span class="m-menu__item-here"></span>
								<span class="m-menu__link-text">
									Configurações
								</span>
							</span>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{ url('/configuracoes/gerenciar-site') }}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Gerenciar Site
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
							<a  href="{{ url('/configuracoes/cadastro') }}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cadastros
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			@endif
			<li class="m-menu__item  m-menu__item--submenu js_principal" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="m-menu__link m-menu__toggle">
					<span class="m-menu__item-here"></span>
					<i class="m-menu__link-icon flaticon-logout"></i>
					<span class="m-menu__link-text">
						Sair
					</span>
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                @csrf
	            </form>
			</li>
		</ul>
	</div>
</div>
