@extends ('layouts.app')
@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>P</span>aquetes del evento
                @foreach($categories as $category)
                    @if($category->id ===4)
                        <span>{{$category->name}}</span></h3>
                    @endif
                @endforeach
                <h5 class="text-center">Nota: Los costos del alquiler son por día</h5>
            </br>
            <div class="row">
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">

                        <div class="table-responsive">
                            <table class="timetable_sub">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Item</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio/Unidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    @if($product->category_id === 4)
                                        <tr class="rem3">
                                            <td >{{$product->code}}</td>
                                            <td class="invert-image">
                                                <img height="150px" width="150px" class="img-responsive" src="{{Storage::url($product->image)}}">
                                                @include('/in_shopping_carts.form_product',['product'=>$product])
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>
                                                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Ingrese una cantidad" pattern="[0-9]{0,15}">
                                            </td>
                                            <td>Bs. {{$product->price}}</td>
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