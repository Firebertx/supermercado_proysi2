@extends('admin.layout')

@section('header')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.ingresos.index')}}"><i class="fa fa-tags"></i> Ingresos</a></li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <main class="main">
        <div class="card-body">
            <h2 class="text-center">Detalles del Ingreso</h2><br/><br/><br/>

            <div class="form-group row">

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Proveedor</label>
                    <p>{{$ingreso->provider->user->name}} {{$ingreso->provider->user->last_name}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="purchase_number">Número de Compra</label>
                    <p> {{$ingreso->purchase_number}}</p>
                </div>

                <div class="col-md-3 ">
                    <label class="form-control-label" for="provider">Estado</label>
                    <p>{{$ingreso->state}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Fecha</label>
                    <p>{{$ingreso->date}}</p>
                </div>

            </div>

            <br/><br/>

            <div class="form-group row border">
                <h3 class="col-md-12">Detalles de los Productos Ingresados</h3>
                <div class="table-responsive col-md-12">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="success">
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio (Bs.)</th>
                            <th>Cantidad</th>
                            <th>SubTotal (Bs.)</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th  colspan="4"><p align="right">TOTAL:</p></th>
                            <th><p align="right">Bs. {{number_format($ingreso->total,2)}}</p></th>
                        </tr>

                        <tr>
                            <th colspan="4"><p align="right">TOTAL IMPUESTO (15%):</p></th>
                            <th><p align="right">Bs. {{number_format($ingreso->total*15/100,2)}}</p></th>
                        </tr>
                        <tr>
                            <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                            <th><p align="right">Bs. {{number_format($ingreso->total+($ingreso->total*15/100),2)}}</p></th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($detalleIngreso as $detalle)
                            @if($detalle->ingreso_id === $ingreso->id)
                                <tr>
                                    <td >
                                        <img height="80px" width="80px" class="img-thumbnail center-block" src="{{Storage::url($detalle->product->image)}}">
                                    </td>
                                    <td>{{$detalle->product->name}}</td>
                                    <td>Bs. {{$detalle->price}}</td>
                                    <td>{{$detalle->quantity}}</td>
                                    <td>Bs. {{number_format($detalle->quantity*$detalle->price,2)}}</td>
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