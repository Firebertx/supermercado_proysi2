
{!! Form::open(['url' => '/in_shopping_carts', 'method'=>'POST', "class"=>"inline-block"])!!}
<input type="hidden" name="combo_id" value="{{$combo->id}}">
<input type="submit" value="Añadir al carrito" class="btn btn-info"/>
{!! Form::close()!!}