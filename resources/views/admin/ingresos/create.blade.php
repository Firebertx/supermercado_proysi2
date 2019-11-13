@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1 class="text-center" >
            Registrar un nuevo ingreso
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.ingresos.index')}}"><i class="fa fa-tags"></i> Ingresos</a></li>
        </ol>
    </section>
@endsection

@section('contenedor')

    <main class="main">
        <div class="card-body">
            <h1 class="text-center">LLenar el formulario</h1>
            <form action="{{route('admin.ingresos.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="provider">Nombre del Proveedor</label>
                        <select class="form-control selectpicker" name="provider" id="provider" data-live-search="true">
                            <option value="0" disabled>Seleccione un proveedor</option>
                            @foreach($providers as $provider)
                                <option value="{{$provider->id}}">{{$provider->nit}} - {{$provider->user->name}} {{$provider->user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="inventory">Nombre del Inventario</label>
                        <select class="form-control selectpicker" name="inventory" id="inventory" data-live-search="true">
                            <option value="0" disabled>Seleccione un inventario</option>
                            @foreach($inventories as $inventory)
                                <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8">
                        <label class="form-control-label" for="purchase_number">Número de Compra</label>
                        <input type="text" id="purchase_number" name="purchase_number" class="form-control" placeholder="Ingrese el número de compra" required pattern="[0-9]{0,15}">
                    </div>
                </div>

                <br/><br/>

                <div class="form-group row border">
                    <div class="col-md-8">
                        <label class="form-control-label" for="product">Producto</label>
                        <select class="form-control selectpicker" name="product_id" id="product_id" data-live-search="true">
                            <option value="0" selected>Seleccione un producto</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="form-control-label" for="quantity">Cantidad</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Ingrese una cantidad" pattern="[0-9]{0,15}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-control-label" for="price">Precio Compra</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Ingrese el precio de compra" pattern="[0-9]{0,15}">
                    </div>

                    <br>
                    <div class="col-md-3">
                        <button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar producto</button>
                    </div>
                </div>

                <br/><br/>

                <div class="form-group row border">
                    <h3 class="col-md-12">Lista de Productos a Ingresar</h3>
                    <div class="table-responsive col-md-12">
                        <table id="detalles" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-success">
                                    <th>Quitar</th>
                                    <th>Producto</th>
                                    <th>Precio (Bs)</th>
                                    <th>Cantidad</th>
                                    <th>SubTotal (Bs)</th>
                                </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total">Bs. 0.00</span> </p></th>
                            </tr>
                            <tr>
                                <th colspan="4"><p align="right">TOTAL IMPUESTO (15%):</p></th>
                                <th><p align="right"><span id="tax">Bs. 0.00</span></p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar_html">Bs. 0.00</span>
                                        <input type="hidden" name="totalview" id="totalview"></p></th>
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

            function agregar(){
                product_id= $("#product_id").val();
                producto= $("#product_id option:selected").text();
                quantity= $("#quantity").val();
                price= $("#price").val();
                tax=20;

                if(product_id !="" && quantity!="" && quantity>0 && price!=""){
                    subtotal[cont]=quantity*price;
                    total= total+subtotal[cont];
                    var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> <td><input type="number" id="price[]" name="price[]"  value="'+price+'"> </td>  <td><input type="number" name="quantity[]" value="'+quantity+'"> </td> <td>Bs.'+subtotal[cont]+' </td></tr>';
                    cont++;
                    limpiar();
                    totales();
                    evaluar();
                    $('#detalles').append(fila);
                }else{
                    // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
                    Swal.fire({
                        type: 'error',
                        //title: 'Oops...',
                        text: 'Rellene todos los campos del detalle de la compras',
                    })
                }
            }

            function limpiar(){
                $("#quantity").val("");
                $("#price").val("");
            }

            function totales(){
                $("#total").html("Bs. " + total.toFixed(2));
                tax=total*tax/100;
                total_pagar=total+tax;
                totalview=total;
                $("#tax").html("Bs. " + tax.toFixed(2));
                $("#total_pagar_html").html("Bs. " + total_pagar.toFixed(2));
                $("#total_pagar").val(total_pagar.toFixed(2));
                $("#totalview").val(totalview.toFixed(2));
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
                tax= total*15/100;
                total_pagar_html = total + tax;
                totalview=total;
                $("#total").html("Bs. " + total);
                $("#tax").html("Bs. " + tax);
                $("#total_pagar_html").html("Bs." + total_pagar_html);
                $("#total_pagar").val(total_pagar_html.toFixed(2));
                $("#totalview").val(totalview.toFixed(2));

                $("#fila" + index).remove();
                evaluar();
            }

        </script>
    @endpush

@endsection
