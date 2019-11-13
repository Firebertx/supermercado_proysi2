@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Reporte de compras
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Ingresos</li>
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
                    <form method="POST" action="{{url('/admin/reporteComprasFechas')}}">
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
                    <form method="POST" action="{{url('/admin/reporteCompras')}}">
                        {{csrf_field()}} {{method_field('POST')}}

                        <div class="form-group col-md-3">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="providers" onclick="check_providers()">
                                    Proveedores
                                </label>
                            </div>
                            <div id="providerData" style="display: none" >
                                <span>(Campos de la tabla proveedor)</span>
                                <div>
                                    <input type="checkbox" name="provider_nit" value="{{$providers->pluck('nit')}}">
                                    <label for="provider_nit">NIT</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_name" value="{{$users->pluck('name')}}">
                                    <label for="provider_name">Nombre</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_last_name" value="{{$users->pluck('last_name')}}">
                                    <label for="provider_last_name">Apellido</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_sex" value="{{$users->pluck('sex')}}">
                                    <label for="provider_sex">Sexo</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_nationality" value="{{$users->pluck('nationality')}}">
                                    <label for="provider_nationality">Nacionalidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_address" value="{{$users->pluck('address')}}">
                                    <label for="provider_address">Dirección</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_city" value="{{$users->pluck('city')}}">
                                    <label for="provider_city">Ciudad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_phone" value="{{$users->pluck('phone')}}">
                                    <label for="provider_phone">Teléfono</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_photo" value="{{$users->pluck('photo')}}">
                                    <label for="provider_photo">Foto de perfil</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="provider_email" value="{{$users->pluck('email')}}">
                                    <label for="provider_email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="inventories" onclick="check_inventories()">
                                    Inventarios
                                </label>
                            </div>
                            <div id="inventorieData" style="display: none" >
                                <span>(Campos de la tabla inventario)</span>
                                <div>
                                    <input type="checkbox" name="inventory_name" value="{{$inventories->pluck('name')}}">
                                    <label for="inventory_name">Nombre</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="inventory_description" value="{{$inventories->pluck('description')}}">
                                    <label for="inventory_description">Descripción</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="inventory_warehouse" value="{{$warehouses->pluck('name')}}">
                                    <label for="inventory_warehouse">Almacén</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="ingresos" onclick="check_ingresos()">
                                    Compras
                                </label>
                            </div>
                            <div id="ingresoData" style="display: none" >
                                <span>(Campos de la tabla compras)</span>
                                <div>
                                    <input type="checkbox" name="ingreso_comprador" value="{{$users->pluck('id')}}">
                                    <label for="ingreso_comprador">Comprador</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="ingreso_purchase_number" value="{{$ingresos->pluck('purchase_number')}}">
                                    <label for="ingreso_purchase_number">Número de compra</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="ingreso_date" value="{{$ingresos->pluck('date')}}">
                                    <label for="ingreso_date">Fecha de compra</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="ingreso_tax" value="{{$ingresos->pluck('tax')}}">
                                    <label for="ingreso_tax">Impuesto</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="ingreso_total" value="{{$ingresos->pluck('total')}}">
                                    <label for="ingreso_total">Total</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="ingreso_state" value="{{$ingresos->pluck('state')}}">
                                    <label for="ingreso_state">Estado</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" id="products" onclick="check_products()">
                                    Productos
                                </label>
                            </div>
                            <div id="productData" style="display: none" >
                                <span>(Detalle de los productos comprados)</span>
                                <div>
                                    <input type="checkbox" name="product_name" value="{{$products->pluck('name')}}">
                                    <label for="product_name">Nombre</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="product_quantity" value="{{$detalleIngreso->pluck('quantity')}}">
                                    <label for="product_quantity">Cantidad</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="product_price" value="{{$detalleIngreso->pluck('price')}}">
                                    <label for="product_price">Precio/Unidad</label>
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
        function check_providers() {
            if($('#providers').is(':checked')) {
                $('#providerData').show('fast');
            } else {
                $('#providerData').hide('fast');
            }
        }
        function check_inventories() {
            if($('#inventories').is(':checked')) {
                $('#inventorieData').show('fast');
            } else {
                $('#inventorieData').hide('fast');
            }
        }
        function check_ingresos() {
            if($('#ingresos').is(':checked')) {
                $('#ingresoData').show('fast');
            } else {
                $('#ingresoData').hide('fast');
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
                        url:"{{ route('IngresosController.fetch') }}",
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