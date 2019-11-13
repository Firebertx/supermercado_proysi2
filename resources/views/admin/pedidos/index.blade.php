@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Solicitudes
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.pedidos.index')}}"><i class="fa fa-credit-card"></i> Solicitudes</a></li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Solicitudes</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new \App\Pedido())
                <p>
                    <a class="fa fa-plus btn btn-primary" href="{{route('admin.pedidos.create')}}"> Registrar un Nueva Solicitud</a>
                </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Fecha de Solicitud</th>
                        <th>Fecha de entrega</th>
                        <th>Hora de entrega</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td> {{$pedido->customer->user->name}} {{$pedido->customer->user->last_name}} </td>
                            <td> {{$pedido->customer->user->email}}</td>
                            <td> {{$pedido->customer->user->phone}}</td>
                            <td> {{$pedido->order_date}}</td>
                            <td> {{$pedido->date}}</td>
                            <td> {{$pedido->hour}}</td>
                            <td>
                                $u$ {{$pedido->total}}
                                <br> </br>
                                Bs. {{$pedido->total*7}}
                            </td>
                            <td>
                                @if($pedido->state == "Pendiente")
                                    <button type="button" class="btn btn-warning btn-md">Pendiente</button>
                                @elseif($pedido->state == "Aceptado")
                                    <button type="button" class="btn btn-success btn-md">Aceptado</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-md">Rechazado</button>
                                @endif
                            </td>
                            <td>
                                @can('view',$pedido)
                                <a href="{{route('admin.pedidos.show',$pedido)}}"
                                   class="btn btn-primary center-block"
                                ><i class="fa fa-eye"> Ver Detalles</i> </a>
                                @endcan

                                {{--CAMBIAR ESTADO DEL PEDIDO--}}
                                @if($pedido->state != "Aceptado" or $pedido->state != "Rechazado")
                                        @if($pedido->state == "Pendiente")
                                            <form method="POST"
                                                  action="{{route('admin.pedidos.update',$pedido)}}"
                                                  style="display: inline">
                                                {{csrf_field()}}    {{method_field('PUT')}}
                                                <input type="hidden" name="state" value="Rechazado">
                                                <button  class="btn btn-danger center-block"
                                                         onclick="return confirm('¿Estás seguro de querer rechazar este pedido?')"
                                                ><i class="fa fa-times"> Rechazar</i></button>
                                            </form>
                                        @endif

                                        @if($pedido->state == "Pendiente")
                                            <form method="POST"
                                                  action="{{route('admin.pedidos.update',$pedido)}}"
                                                  style="display: inline">
                                                {{csrf_field()}}    {{method_field('PUT')}}
                                                <input type="hidden" name="state" value="Aceptado">
                                                <button  class="btn btn-success center-block"
                                                         onclick="return confirm('¿Estás seguro de querer aceptar este pedido?')"
                                                ><i class="fa fa-check">  Aceptar</i></button>
                                            </form>
                                        @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
