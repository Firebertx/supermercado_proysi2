@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Edición de la {{$branchOffice->name}}
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
            height:370px;
            max-height: 100vh;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <center><h3 class="box-title">Edición de la {{$branchOffice->name}}</h3></center>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{route('admin.branchOffices.update', $branchOffice)}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}} {{method_field('PUT')}}


                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" value="{{old('name',$branchOffice->name)}}" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="location">Dirección:</label>
                                <input name="location" value="{{old('location',$branchOffice->address)}}" class="form-control" id="searchmap" type="text" required="">

                            </div>
                            <div class="form-group">
                                <label for="lat">Latitud:</label>
                                <input name="lat" value="{{old('latitude',$branchOffice->latitude)}}" type="text" class="form-control input-sm" id="lat">
                            </div>
                            <div class="form-group">
                                <label for="lng">Longitud:</label>
                                <input name="lng" value="{{old('length',$branchOffice->length)}}" type="text" class="form-control input-sm" id="lng">
                            </div>
                            <div class="form-group">
                                <label for="image">Foto de la sucursal:</label>
                                <center>
                                    <img width="250px" height="250" src="{{Storage::url($branchOffice->image)}}">
                                </center>
                                <input type="file" name="image" value="{{$branchOffice->image}}" class="form-control">
                            </div>

                        </div>
                        <button class="btn btn-primary btn-block">Actualizar ubicación del almacén</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:{{ $branchOffice->latitude}},
                lng:{{ $branchOffice->length}}
            },
            zoom:17
        });

        var marker= new google.maps.Marker({
            position:{
                lat:{{ $branchOffice->latitude}},
                lng:{{ $branchOffice->length}}
            },
            map:map,
            draggable:true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        google.maps.event.addListener(searchBox,'places_changed',function(){
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i , place;
            for(i=0;place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom(17);
        });
        google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#lat').val(lat);
            $('#lng').val(lng);
        });
    </script>
@endsection