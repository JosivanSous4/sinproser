<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$site     = 'sinprosermucaru.com.br';
$sistema   = 'siga.sinprosermucaru.com.br';
$local     = '127.0.0.1:8000';

$host = str_replace(['http://', 'https://', 'http://www.', 'https://www.', 'www.'], '' , url('/'));

if ($host == $site || $host == $local) {

    Route::group(['namespace'=> 'Site'], function() {
        Route::get('/', 'SiteController@index');

        Route::group(['prefix'=> 'links-uteis'], function() {
            Route::get('/', 'SiteController@getLinksUteis');
        });

        Route::group(['prefix'=> 'contato'], function() {
            Route::get('/', 'ContatoController@getIndex');
            Route::post('/enviar-mensagem', 'ContatoController@postEnviarMensagem');
        });

        Route::group(['prefix'=> 'noticias'], function() {
            Route::get('/', 'SiteController@getNoticias');
            Route::get('/{id}/{titulo}', 'SiteController@getNoticia');

            Route::post('/enviar-comentario', 'SiteController@postEnviarComentario');
        });

        Route::group(['prefix'=> '/institucional'], function() {
            Route::get('/quem-somos', 'SiteController@getSobreNos');
            Route::get('/diretoria', 'SiteController@getDiretoria');
        });

    });
}


if ($host == $sistema || $host == $local) {

    Route::get('/sobre-o-sindicato', function(){
        return view('sindicato_print');
    });

    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        // middleware para verificar se o usuário é do perfil 3
        Route::group(['middleware' => ['checkUsuario']], function() {
            Route::get('/', 'HomeController@index')->name('home');

            // Bens
            Route::group(['prefix'=> 'bens'], function(){
                Route::get('/', 'BemController@index');
                Route::get('/api-lista', 'BemController@getListaBens');
                Route::get('/cadastro-de-bens', 'BemController@getCadastroDeBens');
                Route::post('/cadastro-de-bens', 'BemController@postCadastroDeBens');
                Route::get('/editar-bem/{id}', 'BemController@getEditarBem');

                Route::get('/emprestimos', 'BemController@getEmprestimos');
                Route::get('/emprestar-bem/{id}', 'BemController@getEmprestarBens');
                Route::post('/emprestar-bem', 'BemController@postEmprestarBens');

                Route::get('/devolucao/{id}', 'BemController@getDevolucao');
                Route::post('/devolver', 'BemController@postDevolver');
            });

            // Documentos
            Route::group(['prefix'=> 'documentos'], function() {
                Route::get('/', 'DocumentoController@index');
                Route::get('/api-lista', 'DocumentoController@getListaDocumentos');
                Route::get('/emitir-documento', 'DocumentoController@emitirDocumentoGet');
                Route::post('/emitir-documento', 'DocumentoController@emitirDocumentoPost');
                Route::post('/validar-documento', 'DocumentoController@validarDocumento');
                Route::get('/criar-documento', 'DocumentoController@criarDocumentoGet');
                Route::post('/criar-documento', 'DocumentoController@criarOuEditarDocumentoPost');
                Route::get('/editar-documento/{id?}', 'DocumentoController@editarDocumentoGet');
                Route::post('/editar-documento', 'DocumentoController@criarOuEditarDocumentoPost');
            });

            // Financeiro / Config / Tipo entrada
            Route::group(['prefix'=> 'financeiro'], function() {
                Route::group(['prefix'=> 'entrada'], function(){
                    Route::get('/', 'EntradaController@getEntrada')->name('entrada');
                    Route::get('/form-entrada/{id?}', 'EntradaController@form')->name('entrada');
                    Route::post('/form-entrada', 'EntradaController@salvar');
                    Route::get('/get-status', 'EntradaController@getStatusFinanceiro');
                    Route::post('/excluir', 'EntradaController@excluirEntrada');
                    Route::get('/baixa-coletiva', 'EntradaController@formBaixaColetiva');
                    Route::post('/baixa-coletiva', 'EntradaController@baixaColetiva');
                    Route::get('/baixa-coletiva/busca', 'EntradaController@buscarEntradaParaBaixa');
                    Route::get('/recibo/{id?}', 'EntradaController@recibo');
                });

                Route::post('/baixa', 'EntradaController@darBaixa')->name('entrada');
                Route::get('/buscar-entrada', 'EntradaController@buscarEntrada')->name('entrada');
                Route::get('geracaoEntradaMensal', 'EntradaController@geracaoEntradaMensal');

                Route::group(['prefix'=> 'saida'], function(){
                    Route::get('/', 'SaidaController@getSaida')->name('entrada');
                    Route::get('/form-saida', 'SaidaController@form')->name('entrada');
                    Route::post('/form-saida', 'SaidaController@salvar')->name('entrada');
                    Route::get('/buscar-saida', 'SaidaController@buscarSaida')->name('entrada');
                    Route::post('/excluir', 'SaidaController@excluirSaida')->name('entrada');
                });
            });

            // Associados
            Route::group(['prefix'=> 'associados'], function(){
                Route::get('/lista-de-associados/{status?}', 'AssociadoController@getListaDeAssociados')->name('associado');

                // Route::get('/cadastro-de-associado', 'AssociadoController@getCadastroDeAssociado')->name('associado');
                // Route::post('/cadastro-de-associado', 'AssociadoController@postCadastroDeAssociado');

                Route::get('/editar-associado/{id}', 'AssociadoController@getEditarAssociado')->name('associado');
                Route::post('/editar-associado', 'AssociadoController@postEditarAssociado');
                Route::post('/excluir-associado', 'AssociadoController@postExcluirAssociado');
                Route::post('/restaurar-associado', 'AssociadoController@postRestaurarAssociado');
                Route::get('/perfil-associado/{associado_id}/{nome}', 'AssociadoController@getPerfilAssociado')->name('associado');
                Route::get('/get-associado/{id}', 'AssociadoController@getAssociado');

                Route::group(['prefix'=> 'carteirinhas'], function(){
                    Route::get('/', 'CarteirinhaController@getIndex');
                    Route::post('/', 'CarteirinhaController@postIndex');
                });

                Route::group(['prefix'=> 'carteirinha'], function(){
                    Route::get('/{id}', 'CarteirinhaController@getCarteirinha');
                    Route::get('/emitir-carteirinha/{id}', 'CarteirinhaController@getEmitirCarteirinha');
                    Route::get('/marcar-como-impresso/{carteirinha_id}', 'CarteirinhaController@getMarcarComoImpresso');
                });
            });

            // Configurações
            Route::group(['prefix' => 'configuracoes'], function(){
                Route::group(['prefix' => 'cadastro'], function(){
                    Route::get('/', function(){
                        return view('configuracoes.cadastro.index');
                    });

                    Route::group(['prefix' => 'tipos-de-entrada'], function(){
                        Route::get('/', 'TipoEntradaController@index');
                        Route::get('/form-tipo-entrada/{id?}', 'TipoEntradaController@form');
                        Route::post('/form-tipo-entrada', 'TipoEntradaController@salvar');
                    });

                    Route::group(['prefix' => 'tipos-de-saida'], function(){
                        Route::get('/', 'TipoSaidaController@index');
                        Route::get('/form-tipo-saida/{id?}', 'TipoSaidaController@form');
                        Route::post('/form-tipo-saida', 'TipoSaidaController@salvar');
                    });

                    Route::group(['prefix' => 'locais-de-trabalho'], function() {
                        Route::get('/', 'LocalTrabalhoController@getLocaisDeTrabalho');
                        Route::get('/cadastro-de-local-de-trabalho', 'LocalTrabalhoController@getCadastroDeLocalDeTrabalho');
                        Route::post('/cadastro-de-local-de-trabalho', 'LocalTrabalhoController@postCadastroDeLocalDeTrabalho');
                        Route::get('/editar-local-de-trabalho/{id}', 'LocalTrabalhoController@getEditarLocalDeTrabalho');
                        Route::post('/excluir-local-de-trabalho', 'LocalTrabalhoController@getExcluirLocalDeTrabalho');
                    });

                    Route::group(['prefix'=> 'tipos-de-pagamento'], function(){
                        Route::get('/', 'TipoPagamentoController@getIndex');
                        Route::get('/cadastrar-tipo-pagamento', 'TipoPagamentoController@getCadastrarTipoPagamento');
                        Route::post('/cadastrar-tipo-pagamento', 'TipoPagamentoController@postCadastrarTipoPagamento');
                        Route::get('/editar-tipo-pagamento/{id?}', 'TipoPagamentoController@getEditarTipoPagamento');
                        Route::post('/editar-tipo-pagamento', 'TipoPagamentoController@postEditarTipoPagamento');
                        Route::post('/excluir-tipo-pagamento', 'TipoPagamentoController@postExcluirTipoPagamento');
                    });

                    Route::group(['prefix'=> 'areas-de-atuacao'], function(){
                        Route::get('/', 'AreasAtuacaoController@getIndex');
                        Route::get('/cadastrar-area-atuacao', 'AreasAtuacaoController@getCadastrarAreaAtuacao');
                        Route::post('/cadastrar-area-atuacao', 'AreasAtuacaoController@postCadastrarAreaAtuacao');
                        Route::get('/editar-area-atuacao/{id?}', 'AreasAtuacaoController@getEditarAreaAtuacao');
                        Route::post('/editar-area-atuacao', 'AreasAtuacaoController@postEditarAreaAtuacao');
                        Route::post('/excluir-area-atuacao', 'AreasAtuacaoController@postExcluirAreaAtuacao');
                    });

                    Route::group(['prefix'=> 'tipos-de-formacoes'], function(){
                        Route::get('/', 'TipoFormacaoController@getIndex');
                        Route::get('/cadastrar-tipo-formacao', 'TipoFormacaoController@getCadastrarTipoFormacao');
                        Route::post('/cadastrar-tipo-formacao', 'TipoFormacaoController@postCadastrarTipoFormacao');
                        Route::get('/editar-tipo-formacao/{id?}', 'TipoFormacaoController@getEditarTipoFormacao');
                        Route::post('/editar-tipo-formacao', 'TipoFormacaoController@postEditarTipoFormacao');
                        Route::post('/excluir-tipo-formacao', 'TipoFormacaoController@postExcluirTipoFormacao');
                    });
                });

                Route::group(['namespace' => 'Site','prefix'=> 'gerenciar-site'], function(){
                    Route::get('/', 'GerenciarSiteController@getGerenciarSite');
                    Route::get('/noticias', 'NoticiaController@getNoticias');
                    Route::get('/criar-noticia', 'NoticiaController@getCriarNoticia');
                    Route::post('/criar-noticia', 'NoticiaController@postCriarNoticia');

                    Route::get('/editar-noticia/{id}', 'NoticiaController@getEditarNoticia');
                    Route::post('/editar-noticia', 'NoticiaController@postEditarNoticia');

                    Route::group(['prefix'=> 'parceiros'], function(){
                        Route::get('/', 'ParceiroController@index');
                        Route::get('/form-parceiro', 'ParceiroController@getFormParceiro');
                        Route::post('/salvar-parceiro', 'ParceiroController@postSalvarParceiro');
                        Route::post('/excluir-parceiro', 'ParceiroController@postExcluirParceiro');
                    });

                    Route::group(['prefix'=> 'informacoes-sindicato'], function() {
                        Route::get('/', 'InformacoesSindicatoController@cadastrarEditarInformacoesGet');
                        Route::post('/', 'InformacoesSindicatoController@cadastrarEditarInformacoesPost');
                    });

                    Route::group(['prefix'=> 'diretor'], function() {
                        Route::get('/', 'DiretorController@index');
                        Route::get('/form-diretor/{id?}', 'DiretorController@getFormDiretor');
                        Route::post('/salvar-diretor', 'DiretorController@postSalvarDiretor');
                        Route::post('/excluir-diretor', 'DiretorController@postExcluirDiretor');
                    });

                    Route::group(['prefix'=> 'links-uteis'], function() {
                        Route::get('/', 'LinkUtilController@index');
                        Route::get('/form-link/{id?}', 'LinkUtilController@getFormLink');
                        Route::post('/salvar-link', 'LinkUtilController@postSalvarLink');
                        Route::post('/excluir-link', 'LinkUtilController@postExcluirLink');
                    });

                });
            });

            // Usuários
            Route::group(['prefix'=> 'usuarios'], function(){
                Route::get('/', 'UsuarioController@index');
                Route::get('/form-usuario/{user_id?}', 'UsuarioController@form');
                Route::get('/verifica-usuario/{email}', 'UsuarioController@verificarUsuario');
                Route::post('/desativar-usuario', 'UsuarioController@desativarUser');
                Route::post('/salvar-usuario', 'UsuarioController@salvar');
                Route::post('/resetar-usuario', 'UsuarioController@resetarSenha');
                Route::get('/get-usuario-logado', 'UsuarioController@getUsuarioLogado');
            });

            // Relatórios
            Route::group(['prefix'=> 'relatorio'], function(){
                Route::group(['prefix'=> 'financeiro'], function(){
                    Route::get('/entrada', 'Relatorio\FinanceiroController@formEntrada');
                    Route::get('/entrada/busca', 'Relatorio\FinanceiroController@buscarEntrada');
                    Route::get('/saida', 'Relatorio\FinanceiroController@formSaida');
                    Route::get('/saida/busca', 'Relatorio\FinanceiroController@buscarSaida');
                });
            });

            Route::group(['namespace' => 'Site', 'prefix' => 'api-site'], function(){
                Route::get('lista-parceiros', 'ApiController@getParceiros');
                Route::get('noticias', 'ApiController@getNoticias');
                Route::get('diretores', 'ApiController@getDiretores');
                Route::get('links-uteis', 'ApiController@getLinkUtil');
            });

            Route::group(['prefix' => 'tutoriais'], function(){
                Route::get('/', 'TutoriaisController@index');
            });
        });

        Route::group(['prefix'=> 'associados'], function(){
            Route::get('/cadastro-de-associado', 'AssociadoController@getCadastroDeAssociado')->name('associado');
            Route::post('/cadastro-de-associado', 'AssociadoController@postCadastroDeAssociado');
        });

        // Api
        Route::group(['prefix' => 'api'], function(){
            Route::get('lista-estados', 'ApiController@getListaEstados');
            Route::get('lista-cidades/{estado_id}', 'ApiController@getListaCidades');
            Route::get('areas-atuacao', 'ApiController@getListaCidades');
            Route::get('tipos-entrada', 'ApiController@getTiposEntrada');
            Route::get('tipos-saida', 'ApiController@getTiposSaida');
            Route::get('tipos-formacoes', 'ApiController@getTiposFormacoes');
            Route::get('locais-de-trabalho', 'ApiController@getLocaisDeTrabalho');
            Route::get('graus-instrucao', 'ApiController@getGrausInstrucao');
            Route::get('tipos-pagamento', 'ApiController@getTiposPagamento');
            Route::get('areas-atuacao', 'ApiController@getAreasAtuacao');
            Route::get('saida/{said_id?}', 'ApiController@getSaidas');
            Route::get('lista-de-associados/{status?}', 'ApiController@getListaDeAssociados');
            Route::get('saida/{said_id?}', 'ApiController@getSaidas');
            Route::get('entradas/{entrada_id?}', 'ApiController@getEntradas');
            Route::get('total-de-associados', 'ApiController@getQuantidadeDeAssociados');
            Route::get('total-de-associados-professores', 'ApiController@getQuantidadeDeAssociadosProfessores');
            Route::get('total-de-associados-nao-professores', 'ApiController@getQuantidadeDeAssociadosNaoProfessores');
            Route::get('lista-usuarios', 'ApiController@getUsuarios');
            Route::get('lista-perfil', 'ApiController@getPerfil');
            Route::get('aniversariantes-do-mes/{mes?}', 'ApiController@getAniversariantesDoMes');
            Route::get('tipos-pagamento', 'ApiController@getTiposPagamento');
            Route::get('lista-de-responsaveis', 'ApiController@getListaResponsaveis');
            Route::get('get-responsavel/{id}', 'ApiController@getResponsavel');
            Route::get('emprestimos', 'ApiController@getEmprestimos');
            Route::get('dados-grafico-rendimento/{ano?}', 'ApiController@getDadosGraficoRendimento');
        });

    });
}
