@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos del {{$package->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">productos del paquete</li>
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
                {{--@can('create',$packages->first())--}}
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.')}}">Añadir Producto</a>
                </p>
                {{--@endcan--}}
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="col-md-2" >Imagen del producto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Sub total</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($packages as $pack)
                        @if($pack->package->id === $package->id)
                            <tr>
                                <td>
                                    <img height="100px" width="100px" class="img-thumbnail center-block" src="{{Storage::url($pack->product->image)}}">
                                </td>
                                <td>{{$pack->product->name}}</td>
                                <td>{{$pack->quantity}}</td>
                                <td>{{$pack->sub_total}}</td>
                                <td>{{$pack->date}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection