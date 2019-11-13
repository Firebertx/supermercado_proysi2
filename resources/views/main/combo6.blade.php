@extends ('layouts.app')
@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>P</span>roductos del
                @foreach($combos as $combo)
                    @if($combo->id ===6)
                        <span>{{$combo->name}}</span></h3>
            <div class="text-center">@include('/in_shopping_carts.form_package',['package'=>$combo])</div>
            </br>
            @endif
            @endforeach
            <div class="row">
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">

                        <div class="table-responsive">
                            <table class="timetable_sub">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Producto</th>
                                    <th>Detalle</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($combo_products as $combo_product)
                                    @if($combo_product->package_id === 6)
                                        <tr class="rem3">
                                            <td ><h5>{{$combo_product->product->name}}</h5></td>
                                            <td class="invert-image">
                                                <img height="150px" width="150px" class="img-responsive" src="{{Storage::url($combo_product->product->image)}}">
                                            </td>
                                            <td class="invert">
                                                <h5><strong>Categoría: </strong> {{$combo_product->product->category->name}}</h5>
                                                <h5><strong>Marca: </strong> {{$combo_product->product->brand->name}}</h5>
                                                <h5><strong>Unidad de médida: </strong> {{$combo_product->product->unity->name}}</h5>
                                            </td>
                                            <td class="invert">
                                                <h5>
                                                    @if($combo_product->product->description == NULL)
                                                        <i class="text-danger">Sin especificar</i>
                                                    @else
                                                        {{$combo_product->product->description}}
                                                    @endif
                                                </h5>
                                            </td>
                                            <td ><h5>{{$combo_product->quantity}}</h5></td>
                                            <td class="text-center">
                                                <h5>
                                                    <strike>Antes: Bs.{{$combo_product->sub_total}}</strike> </br>
                                                    Ahora: Bs.{{$combo_product->combo->price}}
                                                </h5>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection