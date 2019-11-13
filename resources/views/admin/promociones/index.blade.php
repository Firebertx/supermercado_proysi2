@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Promociones
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Promociones</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Promociones</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Event())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.promociones.create')}}">Crear Promoción</a>
                    </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th class="col-md-">Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="col-md-4">Acciones</th>
                    </thead>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                <center>
                                    <img height="150px" width="150px" class="img-thumbnail" src="{{Storage::url($event->image)}}">
                                </center>
                            </td>
                            <td>{{$event->name}}</td>
                            <td>{{$event->description}}</td>
                            <td>
                                @can('view',$event)
                                    <a href="{{route('admin.promociones.show',$event)}}"
                                       class="btn btn-success"
                                    ><i class="fa fa-eye">Ver Combos</i> </a>
                                @endcan
                                @can('update',$event)
                                    <a href="{{route('admin.promociones.edit',$event)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil">Editar promoción</i> </a>
                                @endcan
                                @can('delete',$event)
                                    <form method="POST"
                                          action="{{route('admin.promociones.destroy',$event)}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar ésta promoción?')"
                                        ><i class="fa fa-times">Eliminar</i></button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection