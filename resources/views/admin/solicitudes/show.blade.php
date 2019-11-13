@extends('admin.layout')

@section('header')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('dashboard')}}"><i class=" active fa fa-credit-card"></i> Solicitudes</a></li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <main class="main">
        <div class="card-body">
            <h2 class="text-center">Detalles de la Solicitud</h2><br/><br/><br/>

            <div class="form-group row">

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Cliente</label>
                    <p>{{$solicitud->customer}}</p>
                </div>

                <div class="col-md-3 ">
                    <label class="form-control-label" for="provider">Estado</label>
                    <p>{{$solicitud->state}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Fecha</label>
                    <p>{{$solicitud->date}}</p>
                </div>

                <div class="col-md-3">
                    <label class="form-control-label" for="provider">Fecha</label>
                    <p>{{$solicitud->hour}}</p>
                </div>

            </div>

            <br/><br/>

            <div class="form-group row border">
                <h3 class="col-md-12">Detalles de los Items requeridos</h3>
                <div class="table-responsive col-md-12">
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="success">
                            <th>Imagen</th>
                            <th>Item</th>
                            <th>Precio</th>
                            <th>Total(Bs.)</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                            <th><p align="right">Bs. {{number_format($solicitud->total,2)}}</p></th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($inshoppingcarts as $inshoppingcart)
                            @if($inshoppingcart->shopping_cart_id === $solicitud->shopping_cart_id)
                                <tr>
                                    <td >
                                        <img height="80px" width="80px" class="img-thumbnail center-block" src="{{Storage::url($detalle->product->image)}}">
                                    </td>
                                    <td>{{$detalle->product->name}}</td>
                                    <td>Bs. {{$detalle->price}}</td>
                                    <td>Bs. {{number_format($detalle->total),2}}</td>
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