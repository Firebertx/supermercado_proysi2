@extends('admin.layout')

@section('header')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Ventas</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <main class="main">
        <div class="card-body">
            <h2 class="text-center">Detalles de la venta</h2><br/><br/><br/>

            <div class="form-group row">

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Cliente</label>
                    <p>{{$egreso->customer->user->name}} {{$egreso->customer->user->last_name}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="purchase_number">Número de Compra</label>
                    <p> {{$egreso->purchase_number}}</p>
                </div>

                <div class="col-md-3 ">
                    <label class="form-control-label" for="provider">Estado</label>
                    <p>{{$egreso->state}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Fecha</label>
                    <p>{{$egreso->date}}</p>
                </div>

            </div>

            <br/><br/>

            <div class="form-group row border">
                <h3 class="col-md-12">Detalles de los Productos Egresados</h3>
                <div class="table-responsive col-md-12">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="success">
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio Venta(Bs.)</th>
                            <th>Descuento/Unidad(Bs.)</th>
                            <th>Cantidad</th>
                            <th>SubTotal (Bs.)</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th  colspan="5"><p align="right">TOTAL:</p></th>
                            <th><p align="right">Bs. {{number_format($egreso->total,2)}}</p></th>
                        </tr>

                        <tr>
                            <th colspan="5"><p align="right">TOTAL IMPUESTO (15%):</p></th>
                            <th><p align="right">Bs. {{number_format($egreso->total*15/100,2)}}</p></th>
                        </tr>
                        <tr>
                            <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                            <th><p align="right">Bs. {{number_format($egreso->total+($egreso->total*15/100),2)}}</p></th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($detalleEgresos as $detalle)
                            @if($detalle->egreso_id === $egreso->id)
                                <tr>
                                    <td >
                                        <img height="80px" width="80px" class="img-thumbnail center-block" src="{{Storage::url($detalle->product->image)}}">
                                    </td>
                                    <td>{{$detalle->product->name}}</td>
                                    <td>Bs. {{$detalle->price}}</td>
                                    <td>Bs. {{$detalle->discount}}</td>
                                    <td>{{$detalle->quantity}}</td>
                                    <td>Bs. {{number_format($detalle->quantity*$detalle->price - ($detalle->quantity*$detalle->discount),2)}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </main>
@endsection