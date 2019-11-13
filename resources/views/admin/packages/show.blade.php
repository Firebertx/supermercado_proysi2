@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos del {{$package->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.packages.index')}}"><i class="fa fa-linode"></i> Combos</a></li>
            <li class="active">Productos del {{$package->name}}</li>
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
                @can('create',new App\Package())
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.packages_products.create')}}">Añadir Producto</a>
                </p>
                @endcan
                <br>
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
                    @foreach($packages as $pack)
                        @if($pack->package->id === $package->id)
                            <tr>
                                <td>
                                    <img height="100px" width="100px" class="img-thumbnail center-block" src="{{Storage::url($pack->product->image)}}">
                                </td>
                                <td class="text-center">{{$pack->product->name}}</td>
                                <td class="text-center">{{$pack->quantity}}</td>
                                <td class="text-center">
                                    <strike>Antes:  {{$pack->sub_total}}</strike> </br>
                                    Ahora: {{$package->price}}
                                </td>
                                <td class="text-center">{{$pack->date}}</td>
                                <td class="text-center">
                                    @can('delete',$package)
                                    <form method="POST"
                                          action="{{route('admin.packages_products.destroy',$pack->id)}}"
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