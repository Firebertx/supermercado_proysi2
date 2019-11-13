<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reporte de compra</title>
<style>
    body {
        position: relative;
        width: 16cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        text-align: justify;
    }

    #encabezado{
        text-align: center;
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
    }

    #fact{
        position: relative;
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        background:#33AFFF;
    }

    section{
        clear: left;
    }

    #cliente{
        text-align: left;
    }

    #faproveedor{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
    }

    #faproveedor thead{
        padding: 20px;
        background:#33AFFF;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
    }

    #faccomprador{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    #faccomprador thead{
        padding: 20px;
        background: #33AFFF;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    #facproducto{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    #facproducto thead{
        padding: 20px;
        background: #33AFFF;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 0.875rem;
        font-weight: normal;
        line-height: 1.5;
        color: #151b1e;
    }
    .table {
        display: table;
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    .table-bordered {
        border: 1px solid #c2cfd6;
    }
    thead {
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
    }
    tr {
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #c2cfd6;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #c2cfd6;
    }
    .table-bordered thead th, .table-bordered thead td {
        border-bottom-width: 2px;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #c2cfd6;
    }
    th, td {
        display: table-cell;
        vertical-align: inherit;
    }
    tbody {
        display: table-row-group;
        vertical-align: middle;
        border-color: inherit;
    }
    tr {
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
    .izquierda{
        float:left;
    }
    .derecha{
        float:right;
    }

</style>
<body>
<header>
    <div id="logo">
        <img src="images/logo2.png" alt="" id="imagen">
    </div>
</header>

<div class="izquierda">
    <h3><strong>Reporte de Compras: </strong>Supermercado ERP</h3>
</div>

<div class="derecha">
    <h3><strong>Fecha: </strong>{{now()}}</h3>
</div>
<br> </br>

<div class="box-body">
    <div class="table-responsive">
        <br> </br>
        <table class="table table-bordered" id="faccomprador" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th >Número Compra</th>
                <th >NIT Proveedor</th>
                <th >Foto Proveedor</th>
                <th >Proveedor</th>
                <th >Nombre Inventario</th>
                <th >Comprador</th>
                <th >Fecha Compra</th>
                <th >Impuesto (Bs)</th>
                <th >Total Compra (Bs)</th>
                <th >Estado Compra</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ingresos as $ingreso)
                @if($ingreso->date >= $fechaInicio and $ingreso->date <= $fechaFinal)
                <tr>
                    <td>{{$ingreso->purchase_number}}</td>
                    <td>{{$ingreso->provider->nit}}</td>
                    <td>
                        {{--<img height="100px" width="100px" src="{{asset('images/providers/'.$ingreso->provider->user->photo)}}">--}}
                        <img height="100px" width="100px" src="images/providers/default.jpg" >
                    </td>
                    <td>{{$ingreso->provider->user->name}} {{$ingreso->provider->user->last_name}}</td>
                    <td>{{$ingreso->inventory->name}}</td>
                    <td>{{$ingreso->user->name}} {{$ingreso->user->last_name}}</td>
                    <td>{{$ingreso->date}}</td>
                    <td>{{$ingreso->tax}}</td>
                    <td>{{$ingreso->total}}</td>
                    <td>{{$ingreso->state}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<br> </br>
<footer>
    <div class="center-block">
        <p id="encabezado">
            <b>Grupo #5</b><br>Sistemas de Información 2<br>Supermercado ERP<br>
        </p>
    </div>
</footer>

</body>
</html>


