
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0072)http://seijnet.com.br/seijnet09/modules/relatorios/rel-inadimplencia.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <title>Relatório de Entrada</title>
    <style type="text/css">
        body {
            padding-top: 30px;
        }
        #btn-imprimir {
            background: #ff0000;
            padding: 8px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        #noprint {
            margin-bottom: 30px;
        }
    </style>
    <style media="print">
        @charset "iso-8859-1";
        .titulo {
            font-family: "Courier New", Courier, monospace;
            font-size: 14pt;
            font-weight: bold;
        }
        .texto {
            font-family: "Courier New", Courier, monospace;
            font-size: 9pt;
            font-weight: normal;
            border-bottom:#666 thin;
        }
        .td_texto {
            font-family:Tahoma, Geneva, sans-serif;
            font-size:8pt;
            border-bottom:#666 thin;
            border-right:thin #666;
        }
        .td_texto_primeiro {
            font-family:Tahoma, Geneva, sans-serif;
            font-size:8pt;
            border-bottom:thin #666;
            border-left:thin #666;
            border-right:thin #666;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgb(245, 245, 245);
        }
        #printable, #printable * {
            visibility: visible;
        }
    </style>
    <style media="screen">
        @charset "iso-8859-1";
        /* CSS Document */
        .titulo {
            font-family: "Courier New", Courier, monospace;
            font-size: 14pt;
            font-weight: bold;
        }
        .texto {
            font-family: "Courier New", Courier, monospace;
            font-size: 9pt;
            font-weight: normal;
            border-bottom:#666 thin;
        }
        .td_texto {
            font-family:Tahoma, Geneva, sans-serif;
            font-size:8pt;
            border-bottom:#666 thin;
            border-right:thin #666;
        }
        .td_texto_primeiro {
            font-family:Tahoma, Geneva, sans-serif;
            font-size:8pt;
            border-bottom:thin #666;
            border-left:thin #666;
            border-right:thin #666;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgb(245, 245, 245);
        }
    </style>
</head>

<body>

    <div align="center" id="noprint">
        <a href="javascript:" onClick="window.print()" id="btn-imprimir" style="font-family:verdana; font-size:11px; ">
            Imprimir
        </a>
    </div>

    <div class="container" id="printable">
        <table width="850" border="0" align="center" class="table-striped" cellpadding="5" cellspacing="1" style="border-collapse: collapse;
        background-color: transparent;">
            <thead>
                <tr class="titulo">
                    <th colspan="9" scope="col">
                        <img src="{{asset('assets/img/logomarca_sem_nome.png')}}" width="60"/>
                    </th>
                </tr>
                <tr class="titulo">
                    <th colspan="9" scope="col">
                        Relatório de Entrada
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="" bgcolor="#CCCCCC" class="texto" width="300">
                        <strong>Pagador</strong>
                    </td>
                    <td align="center" bgcolor="#CCCCCC" class="texto">
                        <strong>Competência</strong>
                    </td>
                    <td align="center" bgcolor="#CCCCCC" class="texto">
                        <strong>Tipo de entrada</strong>
                    </td>
                    <td align="center" bgcolor="#CCCCCC" class="texto">
                        <strong>Valor</strong>
                    </td>
                    <td align="center" bgcolor="#CCCCCC" class="texto">
                        <strong>Data do Pagamento</strong>
                    </td>
                    <td align="center" bgcolor="#CCCCCC" class="texto">
                        <strong>Status</strong>
                    </td>
                </tr>


                <?php $total = 0; ?>
                @foreach($entradas as $entrada)
                <tr bgcolor="#FFFFFF">
                    <td align="" align="center" class="texto">
                        <span style="text-transform: uppercase;">{{$entrada->pagador}}</span>
                    </td>
                    <td align="center" align="center" class="texto">
                        {{date('m/Y', strtotime($entrada->competencia))}}
                    </td>
                    <td align="center" align="center" class="texto">
                        {{$entrada->hasTipoEntrada->nome}}
                    </td>
                    <td align="center" align="center" class="texto">
                        {{number_format($entrada->valor,2,",",".")}}
                    </td>
                    <td align="center"  align="center" class="texto">
                        {{($entrada->data_pagamento ? date('d/m/Y', strtotime($entrada->data_pagamento)) : '')}}
                    </td>
                    <td align="center" align="center" class="texto">
                        <span>{{$entrada->hasStatus->status}}</span>
                    </td>
                </tr>
                <?php $total += $entrada->valor; ?>
                @endforeach
                <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <tr>
                    <td colspan="9" align="center" class="texto">......................................................................................................................</td>
                </tr>
                <tr>
                    <td colspan="9" align="right" class="texto"><strong>Total:R$ {{number_format($total,2,",",".")}} </strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
