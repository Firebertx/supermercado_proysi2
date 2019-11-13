@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos del {{$inventory->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-building-o"></i> Inventarios</a></li>
            <li class="active">productos del {{$inventory->name}}</li>
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
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-md-2" >Imagen del producto</th>
                            <th>Productos</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                            @foreach($detalleInventarios as $detalle)
                                @if($detalle->inventory_id === $inventory->id)
                                    <tr>
                                        <td>
                                            <img height="100px" width="100px" class="img-thumbnail center-block" src="{{Storage::url($detalle->product->image)}}">
                                        </td>
                                        <td>{{$detalle->product->name}}</td>
                                        <td>{{$detalle->stock}}</td>
                                        <td>{{$detalle->total}}</td>
                                    </tr>
                                @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection