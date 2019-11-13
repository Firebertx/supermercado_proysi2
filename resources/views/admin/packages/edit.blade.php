@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos del combo
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">productos del combo</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.packages.update', $event)}}"
              enctype="multipart/form-data">
            {{csrf_field()}}    {{method_field('PUT')}}

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de productos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        {{--@can('create',$packages->first())--}}
                        <p>
                            <a class="btn btn-sm btn-primary" href="{{route('admin.packages.create')}}">Añadir Producto</a>
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
                                @if($pack->event_id === $event->id)
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Actualizar evento</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar Edición' onclick="location.href = '{{ route('admin.events.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection