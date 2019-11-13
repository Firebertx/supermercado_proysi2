@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Paquetes del evento {{$event->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">productos del inventario</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de paquetes</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                {{--@can('create',$packages->first())--}}
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.packages.create')}}">Crear Paquete</a>
                </p>
                {{--@endcan--}}
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="col-md-2" >Imagen del paquete</th>
                        <th>Nombre</th>
                        <th>Cantidad de personas</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th class="col-md-4">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($packages as $pack)
                        @if($pack->event_id === $event->id)  {{--encontre el evento--}}
                        <tr>
                            <td>
                                <img height="100px" width="100px" class="img-thumbnail center-block" src="{{Storage::url($pack->image)}}">
                            </td>
                            <td>{{$pack->name}}</td>
                            <td>{{$pack->amount_of_people}}</td>
                            <td>{{$pack->price}} bs</td>
                            <td>{{$pack->description}}</td>
                            <td>
                                <a href="{{route('admin.packages.show',$pack->id)}}"
                                   class="btn btn-success"
                                ><i class="fa fa-eye"> Ver Productos</i> </a>

                                <form method="POST"
                                      action="{{route('admin.packages.destroy',$pack->id)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de querer eliminar éste paquete?')"
                                    ><i class="fa fa-times"> Eliminar Paquete</i></button>
                                </form>
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
