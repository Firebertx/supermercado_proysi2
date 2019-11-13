@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos con el {{$promotion->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.promotions.index')}}"><i class="fa fa-linode"></i> Promociones</a></li>
            <li class="active">Productos con el {{$promotion->name}}</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de productos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Promotion())
                    <p>
                        <a class="fa fa-plus btn btn-primary" href="{{route('admin.promotions_products.create')}}"> Añadir Producto</a>
                    </p>
                @endcan
                    <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="col-md-2" >Imagen del producto</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio (Bs.)</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($promotions as $one)
                            @if($one->promotion->id === $promotion->id)
                                <tr>
                                    <td>
                                        <img height="100px" width="100px" class="center-block" src="{{Storage::url($one->product->image)}}">
                                    </td>
                                    <td class="text-center">{{$one->product->name}}</td>
                                    <td class="text-center">{{$one->quantity}}</td>
                                    <td class="text-center">
                                        <strike>Antes:  {{$one->product->price}}</strike> </br>
                                        Ahora: {{$one->total}}
                                    </td>
                                    <td class="text-center">{{$one->date}}</td>
                                    <td class="text-center">
                                        @can('delete',$promotion)
                                            <form method="POST"
                                                  action="{{route('admin.promotions_products.destroy',$one->id)}}"
                                                  style="display: inline">
                                                {{csrf_field()}} {{method_field('DELETE')}}
                                                <button class="btn btn-danger"
                                                        onclick="return confirm('¿Estás seguro de querer quitar éste producto?')"
                                                ><i class="fa fa-times">Quitar producto</i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection