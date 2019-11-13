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
                            @php $currentCustomer='' @endphp
                            @foreach($customers as $customer)
                                @if($customer->user_id != $currentCustomer)
                                    <option value="{{$customer->id}}">{{$customer->user->name}} {{$customer->user->last_name}}</option>
                                    @php $currentCustomer = $customer->user_id @endphp
                                @endif
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
                </div>

                <div class="form-group row border">
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