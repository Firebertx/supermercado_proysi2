@extends('layouts.app')

@section('content')
    <style>
        #map-canvas{
            width:500px;
            max-width: 100%;
            height:370px;
            max-height: 100vh;
        }
    </style>

    <div class="privacy py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>M</span>i
                <span>C</span>arrito
            </h3>
            <!-- //tittle heading -->
            <div class="checkout-right">
                <h4 class="mb-sm-4 mb-3">Tu carrito de compras contiene:
                    <span>{{$shopping_cart->productsSize()}} Objetos</span>
                </h4>

                <div class="table-responsive">
                    <table class="timetable_sub">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="rem3">
                                <td><h5>{{$product->name}}</h5></td>
                                <td class="invert-image">
                                    <img height="100px" width="100px" class="img-responsive" src="{{Storage::url($product->image)}}">
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <div class="entry value-minus">&nbsp;</div>
                                            <div class="entry value">
                                                <span>1</span>
                                            </div>
                                            <div class="entry value-plus active">&nbsp;</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert">Bs. {{$product->price}}</td>
                                <td class="invert">
                                    <div class="rem">
                                        <div class="close3"> </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($packages as $package)
                            <tr class="rem3">
                                <td>
                                    <h5>{{$package->name}}</h5>
                                </td>
                                <td class="invert-image">
                                    <img height="100px" width="100px" class="img-responsive" src="{{asset('images/combos/'.$package->image)}}" alt="{{$package->image}}">
                                </td>
                                <td class="invert">{{$package->amount_of_people}}</td>
                                <td class="invert">Bs. {{$package->price}}</td>
                                <td class="invert">
                                    <div class="rem">
                                        <div class="close3"> </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <h4>TOTAL</h4>
                            </td>
                            <td>
                                <h4 class="right-side">$U$ {{number_format($total,2)}}</h4>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    @if(Illuminate\Support\Facades\Auth::check())
                    <h4 class="mb-sm-4 mb-3">Realiza tu solicitud</h4>
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{ route('admin.pedidos.store') }}" class="creditly-card-form agileinfo_form">
                        {{csrf_field()}}
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row, col-md-10 ">

                                    <div class="controls form-group">
                                        <input value="{{old('city')}}" type="text" class="form-control" placeholder="Ciudad" name="city" required="">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="date">Fecha de entrega: </label>
                                            <input value="{{old('date')}}" type="date" class="form-control" name="date" required="">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="date">Hora de entrega: </label>
                                            <input value="{{old('hour')}}" type="time" class="form-control" name="hour" required="">
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-md-6 form-group">
                                            <label>Ubicación</label>
                                            <div id="map-canvas"></div>
                                        </div>
                                        <div class="row col-md-6 form-group">
                                            <div class="col-md-12 form-group">
                                                <label for="location">Lugar de la entrega</label>
                                                <input value="{{old('location')}}" type="text" name="location" id="searchmap">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lat">Latitud</label>
                                                <input value="{{old('lat')}}" type="text" class="form-control input-sm" name="lat" id="lat">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lng">Longitud</label>
                                                <input  value="{{old('lng')}}" type="text" class="form-control input-sm" name="lng" id="lng">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="submit check_out btn" type="submit">Solicitar</button>
                            </div>
                        </div>
                    </form>
                        @foreach($pedidos as $pedido)
                            @if($pedido->customer->user->id === auth()->id() and $pedido->state === 'Aceptado')
                                <div class="checkout-right-basket">
                                    <a href="{{url('/paypal')}}">Hacer pago
                                        <span class="far fa-hand-point-right"></span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <h4 class="mb-sm-4 mb-3">Registrate y realiza tu solicitud</h4>
                        <button class="submit check_out btn" onclick="location.href='{{ route('register') }}'" type="button">
                            Registrarme</button>
                    @endif
                </div>
            </div>
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

        /*
        navigator.geolocation.getCurrentPosition(function (position){ //geolocalización
            var latitud = position.coords.latitude;
            var longitud = position.coords.longitude;
        });
        */

    </script>

@endsection