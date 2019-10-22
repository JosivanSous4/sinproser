
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Recibo</title>
    <link href="{{asset('/assets/css/style.print.css')}}" rel="stylesheet" type="text/css" />
    <head>

        <style type="text/css">
        #noprint{
            background: #ff0000;
            padding: 8px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        <!--
        p{margin: 0 0 0 0;}
        br {margin: 0 0 0 0;}
        .folha {page-break-after: always;}
        -->
        p{
            width: 550px;
            word-wrap: break-word;
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
                        Sindicato dos Professores e Servidores Municipais de São João do Carú<br />
                    </span>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <font size="2" face="tahoma, verdana"  color="#000000">
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
            <tr align="center">
                <td>
                    <span class="nota_dados">
                        RECIBO
                    </span>
                </td>
            </tr>
        </table>

        <br>

        <!-- <hr width="550" size="1" noshade> -->
        <table align="center" width="550" cellpadding="0" cellspacing="0">
            <tr class="nota_texto">
                <td colspan="2">
                    <p>
                        <br />
                        {!!$texto!!}
                    </p>
                </td>
            </tr>
        </table>

        <br><br>

        <table align="center" width="550" cellpadding="0" cellspacing="0">
            <tr align="right">
                <td>
                    <span class="nota_texto">
                        São João do Carú - MA, {{date('d/m/Y')}}
                    </span>
                </td>
            </tr>
        </table>

        <br><br><br><br>

        <table align="center" width="550" cellpadding="0" cellspacing="0">
            <tr align="center">
                <td>
                    <span class="nota_texto">
                        ___________________________________
                    </span>
                </td>
                <td>
                    <span class="nota_texto">
                        ___________________________________
                    </span>
                </td>
            </tr>
            <tr align="center">
                <td>
                    <span class="nota_texto">
                        Tesoureiro
                    </span>
                </td>
                <td>
                    <span class="nota_texto">
                        Presidente
                    </span>
                </td>
            </tr>
        </table>

        <br>

        <!-- <table align="center" width="550" cellpadding="0" cellspacing="0">
            <tr class="nota_texto">
                <td colspan="2">
                    <p>
                        <br />
                        Recebi de %NOME_PAGADOR% sócio de código %CODIGO_ASSOCIADO% admitido em 01/01/2019. Endereço rua 13, cohatrac IV, São Luis - MA
                        a importância de R$ 50,00 referente a quitação do(s) mese(s) de %COMPETÊNCIA%.
                    </p>
                </td>
            </tr>
        </table> -->
    </div><!-- Fim da div folha -->
</body>
