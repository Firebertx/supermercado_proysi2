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

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST"
                          action="{{route('admin.users.update', $customer->user->id)}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}    {{method_field('PUT')}}

                        <img width="100px" src="{{asset('images/customers/'.$customer->user->photo)}}" >
                        <div class="form-group">
                            <label for="photo">Foto de Perfil:</label>
                            <input type="file" name="photo" value="{{$customer->user->photo}}"class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{old('name', $customer->user->name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input name="last_name" value="{{old('last_name', $customer->user->last_name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nacionalidad:</label>
                            <input name="nationality" value="{{old('nationality', $customer->user->nationality)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input name="address" value="{{old('address', $customer->user->address)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Ciudad:</label>
                            <input name="address" value="{{old('city', $customer->user->city)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input name="phone" value="{{old('phone', $customer->user->phone)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sexo:</label>
                            <input name="sex" value="{{old('sex', $customer->user->sex)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{old('email', $customer->user->email)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                            <span class="help-block">Dejar en blanco si no desea cambiar la contraseña</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repetir contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Repetir la contraseña">
                        </div>

                        <button class="btn btn-primary btn-block">Actualizar datos personales del cliente</button>

                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubicación del Cliente</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{route('admin.customers.update', $customer)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        <div class="form-group">
                            <div id="map-canvas"></div>
                        </div>
                        <div class="form-group">
                            <label for="location">Ubicación:</label>
                            <input name="location" value="{{old('location',$customer->location)}}" class="form-control" id="searchmap" type="text">
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitud:</label>
                            <input name="lat" value="{{old('latitude',$customer->latitude)}}" type="text" class="form-control input-sm" id="lat">
                        </div>
                        <div class="form-group">
                            <label for="lng">Longitud:</label>
                            <input name="lng" value="{{old('length',$customer->length)}}" type="text" class="form-control input-sm" id="lng">
                        </div>

                        <button class="btn btn-primary btn-block">Actualizar ubicación del cliente</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:{{ $customer->latitude}},
                lng:{{ $customer->length}}
            },
            zoom:17
        });

        var marker= new google.maps.Marker({
            position:{
                lat:{{ $customer->latitude}},
                lng:{{ $customer->length}}
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