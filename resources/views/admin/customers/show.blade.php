@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Perfil de Cliente
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">clientes</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <style>
        #map-canvas{
            width:500px;
            max-width: 100%;
            height:370px;
            max-height: 100vh;
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('images/customers/'.$customer->user->photo)}}">
                    <h3 class="profile-username text-center">{{$customer->user->name}} {{$customer->user->last_name}}</h3>
                    <p class="text-muted text-center">{{$customer->user->getRoleNames()->implode(', ')}}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Sexo</b> <a class="pull-right">{{$customer->user->sex}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nacionalidad</b> <a class="pull-right">{{$customer->user->nationality}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dirección</b> <a class="pull-right">{{$customer->user->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ciudad</b> <a class="pull-right">{{$customer->user->city}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Teléfono</b> <a class="pull-right">{{$customer->user->phone}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{$customer->user->email}}</a>
                        </li>
                        @if($customer->user->roles->count())
                            <li class="list-group-item">
                                <b>Rol</b> <a class="pull-right">{{$customer->user->getRoleNames()->implode(', ')}}</a>
                            </li>
                        @endif
                    </ul>
                    @can('update', new App\Customer())
                        <a href="{{route('admin.customers.edit',$customer)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubicación del Cliente</h3>
                </div>

                <div class="row ">
                    <div class="col-md-6 form-group">
                        <li class="list-group-item">
                            <div id="map-canvas"></div>
                            <script>
                                var latitude = {{$customer->latitude}};
                                var length = {{$customer->length}};
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
                            <b>Ubicación: </b> </br>
                            <a>{{$customer->location}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ciudad: </b> </br>
                            <a>{{$customer->city}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Latitud: </b> </br>
                            <a>{{$customer->latitude}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Longitud: </b> </br>
                            <a>{{$customer->length}}</a>
                        </li>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection