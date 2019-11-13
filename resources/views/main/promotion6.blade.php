@extends ('layouts.app')
@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>P</span>roductos con el
                @foreach($promotions as $promotion)
                    @if($promotion->id ===6)
                        <span>{{$promotion->name}}</span></h3>
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
                                    <th>Precio</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($promotion_products as $promotion_product)
                                    @if($promotion_product->promotion_id === 6)
                                        <tr class="rem3">
                                            <td ><h5>{{$promotion_product->product->name}}</h5></td>
                                            <td class="invert-image">
                                                <img height="150px" width="150px" class="img-responsive" src="{{Storage::url($promotion_product->product->image)}}">
                                                @include('/in_shopping_carts.form_product',['product'=>$promotion_product->product])
                                            </td>
                                            <td class="invert">
                                                <h5><strong>Categoría: </strong> {{$promotion_product->product->category->name}}</h5>
                                                <h5><strong>Marca: </strong> {{$promotion_product->product->brand->name}}</h5>
                                                <h5><strong>Unidad de médida: </strong> {{$promotion_product->product->unity->name}}</h5>
                                            </td>
                                            <td class="invert">
                                                <h5>
                                                    @if($promotion_product->product->description == NULL)
                                                        <i class="text-danger">Sin especificar</i>
                                                    @else
                                                        {{$promotion_product->product->description}}
                                                    @endif
                                                </h5>
                                            </td>
                                            <td class="text-center">
                                                <h5>
                                                    <strike>Antes: Bs.{{$promotion_product->product->price}}</strike> </br>
                                                    Ahora: Bs.{{$promotion_product->total}}
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