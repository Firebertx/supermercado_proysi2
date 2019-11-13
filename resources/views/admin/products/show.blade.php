@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Característica del producto
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">usuarios</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                        <img width="300px" height="300" class="img-responsive center-block" src="{{Storage::url($product->image)}}">
                    <br>
                    <ul class="list-group with-border ">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <li class="list-group-item">
                            <b>Código</b> <a class="pull-right">{{$product->code}}</a>
                        </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Nombre</b> <a class="pull-right">{{$product->name}}</a>
                            </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Precio</b> <a class="pull-right">{{$product->price}}</a>
                            </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Categoría</b> <a class="pull-right">
                                    @if($product->category_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->category->name}}
                                    @endif
                                </a>
                            </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Marca</b> <a class="pull-right">
                                    @if($product->brand_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->brand->name}}
                                    @endif
                                </a>
                            </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Unidad</b> <a class="pull-right">
                                    @if($product->unity_id == NULL)
                                        <i class="text-danger">Sin especificar</i>
                                    @else
                                        {{$product->unity->name}}
                                    @endif
                                </a>
                            </li>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <li class="list-group-item">
                                <b>Descripción</b> <a class="pull-right">{{$product->description}}</a>
                            </li>
                        </div>

                    </ul>
                </div>
                <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-primary btn-block"><b>Editar Producto</b></a>
                <input type ='button' class="btn btn-success btn-block"  value = 'Volver' onclick="location.href = '{{ route('admin.products.index') }}'"/>
            </div>
        </div>

    </div>
@endsection