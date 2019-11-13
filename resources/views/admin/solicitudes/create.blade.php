@extends('admin.layout')

@section('header')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">egresos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <main class="main">

        <div class="card-body">
            <h3 class="text-center">Formulario de Egreso</h3>

            <form action="{{route('admin.egresos.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="customer">Nombre del Cliente</label>
                        <select class="form-control selectpicker" name="customer" id="customer" data-live-search="true" required>
                            <option value="0" disabled>Seleccione al cliente</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}} {{$customer->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="documento">Documento</label>
                        <select class="form-control" name="tipo_identificacion" id="tipo_identificacion" required>
                            <option value="0" disabled>Seleccione</option>
                            <option value="FACTURA">Factura</option>
                            <option value="TICKET">Ticket</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="purchase_number">Número de venta</label>
                        <input type="text" id="purchase_number" name="purchase_number" class="form-control" placeholder="Ingrese el número venta" pattern="[0-9]{0,15}">
                    </div>
                </div>

                <br/><br/>

                {{--
                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="inventory">Salida del inventario</label>
                        <select class="form-control selectpicker" name="inventory" id="inventory" data-live-search="true" required>
                            <option value="0" disabled>Seleccione un inventario</option>
                            @foreach($inventories as $inventory)
                                <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                            @endforeach
                        </select>
                    </div>2
                </div>

                <div class="form-group row border">
                    <div class="col-md-8">
                        <label class="form-control-label" for="nombre">Producto</label>
                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true" required>
                            <option value="0" selected>Seleccione un producto</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}_{{$product->price}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                --}}
                <div class="form-group row border">
                    <div class="col-md-8">
                        <label class="form-control-label" for="nombre">Producto</label>
                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true" required>
                            <option value="0" selected>Seleccione un producto</option>
                            @foreach($detalles as $detalle)
                                    <option value="{{$detalle->product->id}}_{{$detalle->stock}}_{{$detalle->product->price}}_{{$detalle->inventory->id}}">{{$detalle->product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="form-control-label" for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[0-9]{0,15}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-control-label" for="stock">Stock</label>
                        <input type="number" disabled id="stock" name="stock" class="form-control" placeholder="Stock total" pattern="[0-9]{0,15}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-control-label" for="price">Precio Venta</label>
                        <input type="number" disabled id="price" name="price" class="form-control" placeholder="Precio de venta" >
                    </div>

                    <div class="col-md-2">
                        <label class="form-control-label" for="inventory">ID Inventario</label>
                        <input type="number" disabled id="inventory" name="inventory" class="form-control" placeholder="ID del Inventario">
                    </div>

                    <div class="col-md-2">
                        <label class="form-control-label" for="tax">Descuento/Unidad</label>
                        <input type="number" id="discount" name="discount" class="form-control" placeholder="Ingrese el descuento">
                    </div>

                    <br>
                    <div class="col-md-4">
                        <button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
                    </div>
                </div>

                <br/><br/>

                <div class="form-group row border">

                    <h3 class="col-md-12">Lista de Ventas a Clientes</h3>

                    <div class="table-responsive col-md-12">
                        <table id="detalles" class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr class="bg-success">
                                <th>Eliminar</th>
                                <th>Producto</th>
                                <th>Precio Venta (Bs.)</th>
                                <th>Descuento</th>
                                <th>Cantidad</th>
                                <th>SubTotal (Bs.)</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total">Bs. 0.00</span> </p></th>
                            </tr>

                            <tr>
                                <th colspan="5"><p align="right">TOTAL IMPUESTO (15%):</p></th>
                                <th><p align="right"><span id="total_tax">Bs. 0.00</span></p></th>
                            </tr>

                            <tr>
                                <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar_html">Bs. 0.00</span> <input type="hidden" name="totalview" id="totalview"></p></th>
                            </tr>
                            </tfoot>

                            <tbody>
                            </tbody>

                        </table>
                    </div>

                </div>

                <div class="modal-footer form-group row" id="guardar">
                    <div class="col-md">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Registrar</button>
                    </div>
                </div>
            </form>

        </div>
    </main>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $("#agregar").click(function(){
                    agregar();
                });
            });

            var cont=0;
            total=0;
            subtotal=[];
            $("#guardar").hide();
            $("#product_id").change(mostrarValores);

            function mostrarValores(){
                datosProducto = document.getElementById('product_id').value.split('_');
                $("#price").val(datosProducto[2]);
                $("#inventory").val(datosProducto[3]);
                $("#stock").val(datosProducto[1]);
            }

            function agregar(){
                datosProducto = document.getElementById('product_id').value.split('_');
                product_id= datosProducto[0];
                producto= $("#product_id option:selected").text();
                cantidad= $("#cantidad").val();
                discount= $("#discount").val();
                inventory= $("#inventory").val();
                price= $("#price").val();
                stock= $("#stock").val();
                tax=15;
                if(product_id !="" && cantidad!="" && cantidad>0  && discount!="" && price!=""){
                    if(parseInt(stock)>=parseInt(cantidad)){
                        /*subtotal[cont]=(cantidad*price)-discount;
                        total= total+subtotal[cont];*/
                        //subtotal[cont]=(cantidad*price)-(cantidad*price*discount/100);
                        subtotal[cont]=(cantidad*price)-(cantidad*discount);
                        total= total+subtotal[cont];
                        var fila= '<tr class="selected" id="fila'+cont+'"><td>' +
                            '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> ' +
                            '<td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> ' +
                            '<td><input type="number" name="price[]" value="'+parseFloat(price).toFixed(2)+'"> </td> ' +
                            '<td><input type="number" name="discount[]" value="'+parseFloat(discount).toFixed(2)+'"> </td> ' +
                            '<td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td>Bs.'+parseFloat(subtotal[cont]).toFixed(2)+'</td>' +
                            '<td><input type="hidden" name="inventory[]" value="'+inventory+'"></td> ' +
                            '</tr>';
                        cont++;
                        limpiar();
                        totales();
                        /*$("#total").html("USD$ " + total.toFixed(2));
                        $("#total_venta").val(total.toFixed(2));*/
                        evaluar();
                        $('#detalles').append(fila);
                    } else{
                        //alert("La cantidad a vender supera el stock");
                        Swal.fire({
                            type: 'error',
                            //title: 'Oops...',
                            text: 'La cantidad a vender supera el stock',
                        })
                    }
                }else{
                    //alert("Rellene todos los campos del detalle de la venta");
                    Swal.fire({
                        type: 'error',
                        //title: 'Oops...',
                        text: 'Rellene todos los campos del detalle de la venta',
                    })
                }
            }

            function limpiar(){
                $("#cantidad").val("");
                $("#discount").val("0");
                $("#price").val("");
                $("#inventory").val("");
            }

            function totales(){
                $("#total").html("Bs. " + total.toFixed(2));
                //$("#total_venta").val(total.toFixed(2));
                total_tax=total*tax/100;
                total_pagar=total+total_tax;
                totalview=total;
                $("#total_tax").html("Bs. " + total_tax.toFixed(2));
                $("#total_pagar_html").html("Bs. " + total_pagar.toFixed(2));
                $("#total_pagar").val(total_pagar.toFixed(2));
                $("#totalview").val(total.toFixed(2));
            }


            function evaluar(){
                if(total>0){
                    $("#guardar").show();
                } else{
                    $("#guardar").hide();
                }
            }

            function eliminar(index){
                total=total-subtotal[index];
                total_tax= total*15/100;
                total_pagar_html = total + total_tax;
                //totalview = total;
                $("#total").html("Bs." + total);
                $("#total_tax").html("Bs." + total_tax);
                $("#total_pagar_html").html("Bs." + total_pagar_html);
                $("#total_pagar").val(total_pagar_html.toFixed(2));
                //$("#totalview").val(total.toFixed(2));
                $("#fila" + index).remove();
                evaluar();
            }

        </script>
    @endpush
@endsection


{{--
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
                            <h3 class="box-title">Información del Pedido</h3>
                        </div>

                        <div class="row ">
                            <div class="col-md-6 form-group">
                                <label>Ubicación:</label>
                                <div id="map-canvas"></div>
                            </div>
                            </br>
                            <div class="row col-md-6 form-group">
                                <div class="col-md-12 form-group">
                                    <label for="location">Lugar del evento: </label>
                                    </br>
                                    <input class="col-md-12" value="{{old('location')}}" type="text" name="location" id="searchmap" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="date">Fecha del Evento: </label>
                                    <input value="{{old('date')}}" type="date" class="form-control" name="date" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="date">Hora del Evento: </label>
                                    <input value="{{old('hour')}}" type="time" class="form-control" name="hour" required="">
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
--}}