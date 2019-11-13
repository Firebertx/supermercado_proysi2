@extends('admin.layout')

@section('contenedor')
    <style>
        #map-canvas{
            width:500px;
            max-width: 100%;
            height:370px;
            max-height: 100vh;
        }
    </style>

    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST" action="{{route('admin.customers.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Personales</h3>
                        </div>

                        <div class="form-group">
                            <label for="photo">Foto del cliente:</label>
                            <input type="file" name="photo" value="{{$user->photo}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{old('name')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input name="last_name" value="{{old('last_name')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sexo:</label>
                            <input name="sex" value="{{old('sex')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nacionalidad:</label>
                            <input name="nationality" value="{{old('nationality')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="city">Ciudad:</label>
                            <input name="city" value="{{old('city')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input name="address" value="{{old('address')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input name="phone" value="{{old('phone')}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{old('email')}}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    @include('admin.roles.checkboxes',['model'=>$user])
                </div>

                <div class="col-md-12">
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ubicación del Cliente</h3>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 form-group">
                                <div id="map-canvas"></div>
                            </div>
                            </br>
                            <div class="row col-md-6 form-group">
                                <div class="col-md-12 form-group">
                                    <label for="location">Ubicación: </label>
                                    </br>
                                    <input class="col-md-12" value="{{old('location')}}" type="text" name="location" id="searchmap" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="lat">Latitud: </label>
                                    <input value="{{old('lat')}}" type="text" class="form-control input-sm" name="lat" id="lat">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="lng">Longitud: </label>
                                    <input  value="{{old('lng')}}" type="text" class="form-control input-sm" name="lng" id="lng">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <button class="btn btn-primary btn-block">Registrar cliente</button>
        </form>
    </div>
    </div>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:-17.78332960619302,
                lng:-63.18212999999997
            },
            zoom:17
        });

        var marker= new google.maps.Marker({
            position:{
                lat:-17.78332960619302,
                lng:-63.18212999999997
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