<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8"/>
		<title>
			SINPROSERMUCARU | @yield('title')</title>
		</title>

		<link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}"/>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

	    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-4.1.1.min.css')}}" rel="stylesheet" type="text/css"/>
    	<link href="{{asset('/assets/css/style.print.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/build.css')}}" rel="stylesheet" type="text/css"/>

		<style type="text/css">
	        body {
	            padding-top: 40px;
	        }

	        h1 {
	            font-size: 18px;
	        }

	        p {
	            margin-top: -13px !important;
	        }

	        .titulo {
	            padding-bottom: 10px;
	        }

	        .ql-align-center {
	            text-align: center;
	        }

	        .container {
	            padding-left: 100px;
	            padding-right: 100px;
	        }

	        .text-center {
	            text-align: center;
	        }

	        .text-justify {
	            text-align: justify;
	        }

	        .pull-right {
	            text-align: right;
	        }

	        #footer .page:after {
	            content: counter(page, upper-roman);
	        }

	        @media print {
	            @page {
	                size: auto;
	                margin: 0mm;
	            }
	            body * {
	                visibility: hidden;
	                font-size: 13px;
	            }
	            .container {
	                padding-top: 50px;
	                padding-left: 100px;
	                padding-right: 100px;
	            }
	            #printable, #printable * {
	                visibility: visible;
	            }
	            #printable {
	                position: fixed;
	                left: 0;
	                top: 0;
	            }
	        }

	        #noprint{
	            background: #ff0000;
	            padding: 8px;
	            color: white;
	            text-decoration: none;
	            font-weight: bold;
	        }
	        
	        p {
	        	margin: 0 0 0 0;
	        }

	        br {
	        	margin: 0 0 0 0;
	        }
	        
	        .folha {
	        	page-break-after: always;
	        }
	        
	        p{
	            width: 550px;
	            word-wrap: break-word;
	        }

	        .lacuna {
        		border: white;; 
    		}

			.hidden {
				color: transparent;
				border-color: transparent;
				position: absolute;
			}
	    </style>

	    <script type="text/javascript">
		    function printSetup()
		    {
		        var a = document.all.item("noprint");
		        if (a!=null) {
		            if (a.length!=null) {
		                for (i=0; i< a.length; i++) {
		                    a(i).style.display = window.event.type == "beforeprint" ? "none" :"inline";
		                }
		            } else

		            a.style.display = window.event.type == "beforeprint" ? "none" :"inline";
		        }
		    }
		</script>

	</head>
	<body leftmargin="1" topmargin="0" marginwidth="1" marginheight="0" onbeforeprint="printSetup()" onafterprint="printSetup()">

	    <div align="center" style="margin-bottom: 15px;margin-top: 15px;">
	        <a href="javascript:" onClick="window.print()" id="noprint" style="font-family:verdana; font-size:11px; ">
	            Imprimir
	        </a>
	    </div>

		<div class="folha">
	        <table width="550" align="center" cellpadding="0" cellspacing="0">
	            <tr align="center">
	                <td colspan="2"><img src="{{asset('assets/img/logomarca_sem_nome.png') }}" width="70"></td>
	            </tr>
	            <tr align="center" >
	                <td height="30" colspan="2" align="center">
	                    <span class="titulo_pagina">
	                        SINDICATO DOS PROFESSORES E SERVIDORES MUNICIPAIS DE SÃO JOÃO DO CARÚ<br />
	                    </span>
	                </td>
	            </tr>
	            <tr>
	                <td align="center">
	                    <font size="2" face="tahoma, verdana" color="#000000">
	                        CNPJ: 07.799.664/0001-30 <br>
	                        <font size="2" face="tahoma, verdana">
	                            Rua do comércio, 09 - Centro - São João do Carú - MA
	                        </font>
	                    </font>
	                </td>
	            </tr>
	        </table>

	        <font size="2" face="tahoma, verdana"><br></font>

	        <br>

	        <table align="center" width="550" cellpadding="0" cellspacing="0">
	            <tr class="nota_texto">
	                <td colspan="2">
	                    <p>
	                        <div id="app">
								@yield('content')
							</div>
	                    </p>
	                </td>
	            </tr>
	        </table>

	        <br><br><br>

    	</div>
					<div id="rascunho" class="hidden" ></div>

	    <script src="{{asset('assets/global/plugins/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap-4.1.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/js/build.js')}}" type="text/javascript"></script>

		<script type="text/javascript">
			
			function calculateTextWidth(text) {
				$('#rascunho').html('<span class="texto">'+text+'</span>');
				var largura = $('#rascunho').find('span.texto').width();

			    return largura > 5? largura : 180;
			}

			$('.tamanho-dinamico').keyup(function(){
				var width = calculateTextWidth($(this).val());
				// console.log(width, calculateTextWidth('text'));
				$(this).width(width);
			});
		</script>
	</body>
</html>