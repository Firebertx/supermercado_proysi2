@extends('admin.layout')

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.products.update', $product)}}"
              enctype="multipart/form-data">
            {{csrf_field()}}    {{method_field('PUT')}}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Detalles del Producto</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="code">Código de producto: </label>
                                <input disabled value="{{ $product->code }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                        @role('Administrador')

                            <div class="form-group">
                                <label>Categoría:</label>
                                <select name="category" class="form-control">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                {{old('category',$product->category_id)== $category->id ? 'selected':''}}
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                <div class="form-group">
                                    <label>Categoría:</label>
                                    <input disabled value="{{$product->category->name}}" class="form-control">
                                </div>
                        @endrole
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" value="{{old('name', $product->name)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            @role('Administrador')
                            <div class="form-group">
                                <label>Marca: </label>
                                <select name="brand" class="form-control">
                                    <option value="">Seleccione una marca</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}"
                                                {{old('brand',$product->brand_id)== $brand->id ? 'selected':''}}
                                        >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                <div class="form-group">
                                    <label>Marca: </label>
                                    <input disabled value="{{$product->brand->name}}" class="form-control">
                                </div>
                                @endrole
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="price">Precio:</label>
                                <input name="price" value="{{old('price', $product->price)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            @role('Administrador')
                            <div class="form-group">
                                <label>Unidad: </label>
                                <select name="unity" class="form-control">
                                    <option value="">Seleccione una unidad</option>
                                    @foreach($unities as $unity)
                                        <option value="{{$unity->id}}"
                                                {{old('unity',$product->unity_id)== $unity->id ? 'selected':''}}
                                        >{{$unity->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                <div class="form-group">
                                    <label>Unidad: </label>
                                    <input disabled value="{{$product->unity->name}}" class="form-control">
                                </div>
                                @endrole
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description', $product->description)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <label for="image">Imagen del producto:</label>
                            <div class="form-group">
                                <center>
                                    <img width="250px" height="250" src="{{Storage::url($product->image)}}">
                                </center>
                                <input type="file" name="image" value="{{$product->image}}"class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block">Actualizar producto</button>
            <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar Edición' onclick="location.href = '{{ route('admin.products.index') }}'"/>
        </form>
    </div>
@endsection