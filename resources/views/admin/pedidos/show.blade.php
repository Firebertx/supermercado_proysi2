@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Solicitud de {{$pedido->customer->user->name}} {{$pedido->customer->user->last_name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.pedidos.index')}}"><i class=" active fa fa-credit-card"></i> Solicitudes</a></li>
            <li class="active">{{$pedido->customer->user->name}} {{$pedido->customer->user->last_name}}</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <style>
        #map-canvas{
            width:500px;
            max-width: 100%;
            height:400px;
            max-height: 100vh;
        }
    </style>

    <div class="box">
        <div class="box-header">
            <h3 class="text-center">Detalles de la Solicitud</h3>
        </div>
        <div class="box-body">
            <div class="form-group row">

                <div class="col-md-6">
                    <div id="map-canvas"></div>
                    <script>
                        var map = new google.maps.Map(document.getElementById('map-canvas'),{
                            center:{
                                lat:{{$pedido->customer->latitude}},
                                lng:{{$pedido->customer->length}}
                            },
                            zoom:15
                        });

                        var marker= new google.maps.Marker({
                            position:{
                                lat:{{$pedido->customer->latitude}},
                                lng:{{$pedido->customer->length}}
                            },
                            map:map,
                        });
                    </script>
                </div>

                <div class="col-md-6">
                    <li class="list-group-item">
                        <b>Cliente: </b> </br>
                        <a>{{$pedido->customer->user->name}} {{$pedido->customer->user->last_name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Correo Electrónico: </b> </br>
                        <a>{{$pedido->customer->user->email}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Teléfono: </b> </br>
                        <a>{{$pedido->customer->user->phone}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Estado: </b> </br>
                        <a>{{$pedido->state}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Fecha de solicitud: </b> </br>
                        <a>{{$pedido->order_date}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Fecha de envio: </b> </br>
                        <a>{{$pedido->date}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Hora de envio: </b> </br>
                        <a>{{$pedido->hour}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Ubicación: </b> </br>
                        <a>{{$pedido->customer->location}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Total: </b> </br>
                        <a>$u$ {{$pedido->total}} </br>
                           Bs. {{number_format($pedido->total*7)}}
                        </a>
                    </li>
                </div>

            </div>

            <br/><br/>

            <div class="form-group row border">
                <h3 class="col-md-12">Detalles de los Items requeridos</h3>

                <div class="table-responsive col-md-12">

                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="success">
                            <th class="col-md-3">Imagen</th>
                            <th class="col-md-3">Item</th>
                            <th class="col-md-3">Cantidad</th>
                            <th class="col-md-3">Precio</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($inshoppingcarts as $inshoppingcart)
                                @if($inshoppingcart->shopping_cart_id === $pedido->shopping_cart_id && $inshoppingcart->product!=null)
                                    <tr>
                                        <td >
                                            <img height="100px" width="100px" class="img-thumbnail center-block" src="{{Storage::url($inshoppingcart->product->image)}}">
                                        </td>
                                        <td>{{$inshoppingcart->product->name}}</td>
                                        <td>1</td>
                                        <td>Bs. {{$inshoppingcart->product->price}}</td>
                                    </tr>
                                @endif
                            @endforeach

                            @foreach($inshoppingcarts as $inshoppingcart)
                                @if($inshoppingcart->shopping_cart_id === $pedido->shopping_cart_id && $inshoppingcart->package!=null)
                                    <tr>
                                        <td >
                                            <img height="100px" width="100px" class="img-thumbnail center-block" src="{{asset('images/combos/'.$inshoppingcart->package->image)}}" alt="{{$inshoppingcart->package->image}}">
                                        </td>
                                        <td>{{$inshoppingcart->package->name}}</td>
                                        <td>1</td>
                                        <td>Bs. {{$inshoppingcart->package->price}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th colspan="6"><p align="right">TOTAL PAGAR:
                                    $u$.{{number_format($pedido->total,2)}}
                                    /Bs.{{number_format($pedido->total*7)}}
                                </p>
                            </th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection