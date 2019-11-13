@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">productos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <!-- DataTables -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Productos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                {{--@can('create',$products->first())--}}
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.products.create')}}">Crear Producto</a>
                    </p>
                {{--@endcan--}}
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th class="col-md-5">Detalles</th>
                    <th class="col-md-4">Imagen</th>
                    <th class="col-md-3">Opciones</th>
                    </thead>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <h5><strong>ID: </strong> {{$product->id}}</h5>
                                <h5><strong>Código: </strong> {{$product->code}}</h5>
                                <h5><strong>Nombre: </strong> {{$product->name}} </h5>
                                <h5><strong>Unidad: </strong>
                                    @if($product->unity_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->unity->name}}
                                    @endif
                                </h5>
                                <h5><strong>Categoría: </strong>
                                    @if($product->category_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->category->name}}
                                    @endif
                                </h5>
                                <h5><strong>Marca: </strong>
                                    @if($product->brand_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->brand->name}}
                                    @endif
                                </h5>
                                <h5><strong>Descripción: </strong>
                                    @if($product->description == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->description}}
                                    @endif
                                </h5>
                                <h5><strong>Precio: </strong> {{$product->price}} Bs.</h5>
                            </td>

                            <td>
                                <center>
                                    <img height="200px" width="200px" class="img-thumbnail" src="{{Storage::url($product->image)}}">
                                </center>

                            </td>

                            <td>
                                {{--@can('view',$product)--}}
                                    <a href="{{route('admin.products.show',$product)}}"
                                       class="btn btn-success"
                                            {{--target="_blank" //para abrir en otra pestaña--}}
                                    ><i class="fa fa-eye"> Ver</i> </a>
                            {{--@endcan--}}
                            {{--@can('update',$product)--}}
                                <a href="{{route('admin.products.edit',$product)}}"
                                   class="btn btn-info"
                                ><i class="fa fa-pencil"> Editar</i> </a>
                            {{--@endcan--}}
                            {{--@can('delete',$product)--}}
                                <form method="POST"
                                      action="{{route('admin.products.destroy',$product)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de querer eliminar éste producto?')"
                                    ><i class="fa fa-times"> Eliminar</i></button>
                                </form>
                            {{--@endcan--}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection