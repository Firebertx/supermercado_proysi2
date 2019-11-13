@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Ubicación del {{$warehouse->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.warehouses.index')}}"><i class="fa fa-building"></i> Almacenes</a></li>
            <li class="active">{{$warehouse->name}}</li>
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

    <div class="row">
        <div class="col-md-112">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Información del {{$warehouse->name}}</h3>
                </div>

                <div class="row ">
                    <div class="col-md-6 form-group">
                        <li class="list-group-item">
                            <div id="map-canvas"></div>
                            <script>
                                var latitude = {{$warehouse->latitude}};
                                var length = {{$warehouse->length}};
                                var map = new google.maps.Map(document.getElementById('map-canvas'),{
                                    center:{
                                        lat:latitude,
                                        lng:length
                                    },
                                    zoom:15
                                });

                                var marker= new google.maps.Marker({
                                    position:{
                                        lat:latitude,
                                        lng:length
                                    },
                                    map:map,
                                });
                            </script>
                        </li>
                    </div>
                    <div class="row col-md-6 form-group">
                        <li class="list-group-item">
                            <b>Nombre del almacén: </b> </br>
                            <a>{{$warehouse->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ubicación: </b> </br>
                            <a>{{$warehouse->location}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Latitud: </b> </br>
                            <a>{{$warehouse->latitude}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Longitud: </b> </br>
                            <a>{{$warehouse->length}}</a>
                        </li>
                        </br>
                        @can('update', new App\Warehouse())
                            <a href="{{route('admin.warehouses.edit',$warehouse)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection