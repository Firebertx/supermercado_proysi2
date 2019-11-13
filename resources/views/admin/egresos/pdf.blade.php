@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Reporte de ventas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Egresos</li>
        </ol>
    </section>
@endsection

@section('contenedor')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporte por fechas</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{url('/admin/reporteVentasFechas')}}">
                        {{csrf_field()}} {{method_field('POST')}}

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="date_inicio">Fecha Inicio: </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="date_inicio" value="{{old('date_inicio')}}" type="date" class="form-control pull-right">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="date_final">Fecha Final: </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input value="{{old('date_final')}}" type="date" class="form-control pull-right" name="date_final" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Crear reporte PDF por rango de fecha</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporte por campos</h3>
                </div>

                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{url('/admin/reporteVentas')}}">
                        {{csrf_field()}} {{method_field('POST')}}

                        <div class="form-group col-md-4">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="customers" onclick="check_customers()">
                                    Clientes
                                </label>
                            </div>
                            <div id="customerData" style="display: none" >
                                <span>(Campos de la tabla clientes)</span>
                                <div>
                                    <input type="checkbox" name="customer_location" value="{{$customers->pluck('location')}}">
                                    <label for="customer_location">Ubicación</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_name" value="{{$users->pluck('name')}}">
                                    <label for="customer_name">Nombre</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_last_name" value="{{$users->pluck('last_name')}}">
                                    <label for="customer_last_name">Apellido</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_sex" value="{{$users->pluck('sex')}}">
                                    <label for="customer_sex">Sexo</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_nationality" value="{{$users->pluck('nationality')}}">
                                    <label for="customer_nationality">Nacionalidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_address" value="{{$users->pluck('address')}}">
                                    <label for="customer_address">Dirección</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_city" value="{{$users->pluck('city')}}">
                                    <label for="customer_city">Ciudad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_phone" value="{{$users->pluck('phone')}}">
                                    <label for="customer_phone">Teléfono</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_photo" value="{{$users->pluck('photo')}}">
                                    <label for="customer_photo">Foto de perfil</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_email" value="{{$users->pluck('email')}}">
                                    <label for="customer_email">Email</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_latitude" value="{{$customers->pluck('latitude')}}">
                                    <label for="customer_latitude">Latitud</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="customer_length" value="{{$customers->pluck('length')}}">
                                    <label for="customer_length">Longitud</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="egresos" onclick="check_egresos()">
                                    Ventas
                                </label>
                            </div>
                            <div id="egresoData" style="display: none" >
                                <span>(Campos de la tabla ventas)</span>
                                <div>
                                    <input type="checkbox" name="egreso_vendedor" value="{{$users->pluck('id')}}">
                                    <label for="egreso_vendedor">Vendedor</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="egreso_purchase_number" value="{{$egresos->pluck('purchase_number')}}">
                                    <label for="egreso_purchase_number">Número de venta</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="egreso_date" value="{{$egresos->pluck('date')}}">
                                    <label for="egreso_date">Fecha de venta</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="egreso_tax" value="{{$egresos->pluck('tax')}}">
                                    <label for="egreso_tax">Impuesto</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="egreso_total" value="{{$egresos->pluck('total')}}">
                                    <label for="egreso_total">Total</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="egreso_state" value="{{$egresos->pluck('state')}}">
                                    <label for="egreso_state">Estado</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="products" onclick="check_products()">
                                    Productos
                                </label>
                            </div>
                            <div id="productData" style="display: none" >
                                <span>(Detalle de los productos vendidos)</span>
                                <div>
                                    <input type="checkbox" name="product_name" value="{{$products->pluck('name')}}">
                                    <label for="product_name">Nombre</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="product_quantity" value="{{$detalleEgreso->pluck('quantity')}}">
                                    <label for="product_quantity">Cantidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="product_price" value="{{$detalleEgreso->pluck('price')}}">
                                    <label for="product_price">Precio/Unidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="product_discount" value="{{$detalleEgreso->pluck('discount')}}">
                                    <label for="product_discount">Descuento</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Crear reporte PDF por campos</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-group ">
                <button class="btn btn-success btn-block" onclick="imprimir()">Imprimir</button>
            </div>
        </div>
    </div>


    <script>
        function check_customers() {
            if($('#customers').is(':checked')) {
                $('#customerData').show('fast');
            } else {
                $('#customerData').hide('fast');
            }
        }
        function check_egresos() {
            if($('#egresos').is(':checked')) {
                $('#egresoData').show('fast');
            } else {
                $('#egresoData').hide('fast');
            }
        }
        function check_products() {
            if($('#products').is(':checked')) {
                $('#productData').show('fast');
            } else {
                $('#productData').hide('fast');
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EgresosController.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+dependent).html(result);
                        }
                    })
                }
            });
            $('#country').change(function(){
                $('#state').val('');
                $('#city').val('');
            });

            $('#state').change(function(){
                $('#city').val('');
            });
        });
    </script>

    <script>
        function imprimir() {
            window.print();
        }
        function volver() {
            window.close();
        }
    </script>
@endsection