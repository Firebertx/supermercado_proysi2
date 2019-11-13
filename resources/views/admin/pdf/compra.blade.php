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
                @if($data!=null)
                    <th >Número Compra</th>
                @endif
                @if($data1!=null)
                    <th >NIT Proveedor</th>
                @endif

                @if($data2!=null)
                    <th >Foto Proveedor</th>
                @endif
                @if($data3!=null)
                    <th >Nombre Proveedor</th>
                @endif
                @if($data4!=null)
                    <th >Apellido Proveedor</th>
                @endif
                @if($data5!=null)
                    <th >Sexo Proveedor</th>
                @endif
                @if($data6!=null)
                    <th >Nacionalidad Proveedor</th>
                @endif
                @if($data7!=null)
                    <th >Dirección Proveedor</th>
                @endif
                @if($data8!=null)
                    <th >Ciudad Proveedor</th>
                @endif
                @if($data9!=null)
                    <th >Teléfono Proveedor</th>
                @endif
                @if($data10!=null)
                    <th >Email Proveedor</th>
                @endif
                @if($data11!=null)
                    <th >Nombre Inventario</th>
                @endif
                @if($data12!=null)
                    <th >Descripción Inventario</th>
                @endif
                @if($data13!=null)
                    <th >Almacén Inventario</th>
                @endif
                @if($data14!=null)
                    <th >Comprador</th>
                @endif
                @if($data15!=null)
                    <th >Fecha Compra</th>
                @endif
                @if($data16!=null)
                    <th >Impuesto Compra</th>
                @endif
                @if($data17!=null)
                    <th >Total Compra (Bs)</th>
                @endif
                @if($data18!=null)
                    <th >Estado Compra</th>
                @endif
                @if($data19!=null)
                    <th >Productos</th>
                @endif
                @if($data20!=null)
                    <th >Cantidad Producto</th>
                @endif
                @if($data21!=null)
                    <th >Precio Producto</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($ingresos as $ingreso)
            <tr>
                @if($data!=null)
                    <td>{{$ingreso->purchase_number}}</td>
                @endif
                @if($data1!=null)
                    <td>{{$ingreso->provider->nit}}</td>
                @endif
                @if($data2!=null)
                    <td>
                        {{--<img height="100px" width="100px" src="{{asset('images/providers/'.$ingreso->provider->user->photo)}}">--}}
                        <img height="100px" width="100px" src="images/providers/default.jpg" >
                    </td>
                @endif
                @if($data3!=null)
                    <td>{{$ingreso->provider->user->name}}</td>
                @endif
                @if($data4!=null)
                    <td>{{$ingreso->provider->user->last_name}}</td>
                @endif
                @if($data5!=null)
                    <td>{{$ingreso->provider->user->sex}}</td>
                @endif
                @if($data6!=null)
                    <td>{{$ingreso->provider->user->nationality}}</td>
                @endif
                @if($data7!=null)
                    <td>{{$ingreso->provider->user->address}}</td>
                @endif
                @if($data8!=null)
                    <td>{{$ingreso->provider->user->city}}</td>
                @endif
                @if($data9!=null)
                    <td>{{$ingreso->provider->user->phone}}</td>
                @endif
                @if($data10!=null)
                    <td>{{$ingreso->provider->user->email}}</td>
                @endif
                @if($data11!=null)
                    <td>{{$ingreso->inventory->name}}</td>
                @endif
                @if($data12!=null)
                    <td>{{$ingreso->inventory->description}}</td>
                @endif
                @if($data13!=null)
                    <td>{{$ingreso->inventory->warehouse->name}}</td>
                @endif
                @if($data14!=null)
                    <td>{{$ingreso->user->name}} {{$ingreso->user->last_name}}</td>
                @endif
                @if($data15!=null)
                    <td>{{$ingreso->date}}</td>
                @endif
                @if($data16!=null)
                    <td>{{$ingreso->tax}}</td>
                @endif
                @if($data17!=null)
                    <td>{{$ingreso->total}}</td>
                @endif
                @if($data18!=null)
                    <td>{{$ingreso->state}}</td>
                @endif

                @if($data19!=null)
                    <td>
                        @foreach($detalleIngreso as $product)
                            @if($product->ingreso_id == $ingreso->id)
                                {{$product->product->name}}, <br> </br>
                            @endif
                        @endforeach
                    </td>
                @endif
                @if($data20!=null)
                    <td>
                        @foreach($detalleIngreso as $product)
                            @if($product->ingreso_id == $ingreso->id)
                                {{$product->quantity}}, <br> </br>
                            @endif
                        @endforeach
                    </td>
                @endif
                @if($data21!=null)
                    <td>
                        @foreach($detalleIngreso as $product)
                            @if($product->ingreso_id == $ingreso->id)
                                {{$product->price}}, <br> </br>
                            @endif
                        @endforeach
                    </td>
                @endif

            </tr>
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


