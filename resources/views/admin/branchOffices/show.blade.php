@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Ubicación de la {{$branchOffice->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.branchOffices.index')}}"><i class="fa fa-university"></i> Sucursales</a></li>
            <li class="active">{{$branchOffice->name}}</li>
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
                    <center><h3 class="box-title ">Información de la {{$branchOffice->name}}</h3></center>
                </div>

                <div class="row ">
                    <div class="col-md-6 form-group">
                        <li class="list-group-item">
                            <div id="map-canvas"></div>
                            <script>
                                var map = new google.maps.Map(document.getElementById('map-canvas'),{
                                    center:{
                                        lat:{{$branchOffice->latitude}},
                                        lng:{{$branchOffice->length}}
                                    },
                                    zoom:15
                                });
                                var marker= new google.maps.Marker({
                                    position:{
                                        lat:{{$branchOffice->latitude}},
                                        lng:{{$branchOffice->length}}
                                    },
                                    map:map,
                                });
                            </script>
                        </li>
                    </div>
                    <div class="row col-md-6 form-group">
                        <li class="list-group-item">
                            <img width="200px" height="300" class="img-responsive center-block" src="{{Storage::url($branchOffice->image)}}">
                        </li>
                        <li class="list-group-item">
                            <b>Nombre de la sucursal: </b> </br>
                            <a>{{$branchOffice->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dirección: </b> </br>
                            <a>{{$branchOffice->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Latitud: </b> </br>
                            <a>{{$branchOffice->latitude}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Longitud: </b> </br>
                            <a>{{$branchOffice->length}}</a>
                        </li>
                        </br>
                        @can('update', new App\BranchOffice())
                            <a href="{{route('admin.branchOffices.edit',$branchOffice)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection