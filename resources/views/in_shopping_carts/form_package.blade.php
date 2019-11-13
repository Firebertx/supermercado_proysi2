
{!! Form::open(['url' => '/in_shopping_carts', 'method'=>'POST', "class"=>"inline-block"])!!}
    <input type="hidden" name="package_id" value="{{$package->id}}">
    <input type="submit" value="Añadir al carrito" class="btn btn-info"/>
{!! Form::close()!!}