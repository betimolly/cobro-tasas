<!DOCTYPE html>
<html>
<head>
    <title>Municipalidad de General Enrique Godoy</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 90%;
            font-size:10px;
        }
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        #customers tfoot{
            border: 1px solid #ddd;
            padding: 8px;
        }
        tfoot tr td {
            font-weight: bold;
            font-size:12px;
        }
        .invoice table {
            margin: 15px;
            margin-left: 35px;
        }
        /*.invoice h3 {
            margin-left: 15px;
        }*/
        .information {
           /* background-color: #60A7A6;
            color: #FFF;*/
            font-size:14px;
            padding-left: 1em;
            background-color: #f1f6fa;
            border-bottom: 5px solid #99CC33;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        /*.header-branding {
            background-color: #f1f6fa;
            border-bottom: 5px solid #99CC33;
        }*/
    </style>  
</head>
<body>
<div class="information">
    <table width="100%">
        <tr>
            <td>
                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/img/Escudo.png'))); ?>" width="50">
            </td>
            <td>
                {{ $title }}
            </td>
            <td>
                {{ $date }}
            </td>
        </tr>
    </table>
</div>
<div>
    <table width="90%" style="font-size: 8px;margin-left: 35px">
        <tr>
            <td>
                Número de Partida: {{ $facturacion->nro_imponible }}
            </td>
            <td align="right">
                Fecha de Vencimiento: {{ date("d-m-Y", strtotime($facturacion->fecha_vencimiento)) }}
            </td>
        </tr>
        <tr>
            <td>
                Domicilio: {{ $facturacion->domicilio }}
            </td>
            <td align="right">
                Total a pagar: $ {{ $facturacion->total_1 }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="right">
                Con recargo al {{ date("d-m-Y", strtotime($facturacion->fecha_2_vencimiento)) }} {{ "$ ".$facturacion->total_2 }}
            </td>
        </tr>
    </table>
</div>
<div class="invoice" style="overflow-x:auto;">
    <h4 align="center" style="font-size: 12px;">Pago de {{ $facturacion->descripcion_imponible }}</h4>
    <table id="customers">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conceptos as $c) 
            <tr>
                <td align="left">{{ $c->concepto }}</td>
                <td align="right">{{ $c->cantidad }}</td>
                <td align="right">{{ '$ '.$c->total_concepto }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" align="right">Total</td>
                <td align="right">{{ '$ '.$facturacion->total_1 }}</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <img src={{ $barcode }}  />
                </td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>