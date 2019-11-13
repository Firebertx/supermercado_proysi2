@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Unidades
            {{--<small>Categoría</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">unidades</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Unidades</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',$units->first())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.units.create')}}">Crear Unidad</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-4">Nombre</th>
                        <th class="col-md-4">Descripción</th>
                        <th class="col-md-3">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unity)
                        <tr>
                            <td> {{$unity->id}}</td>
                            <td>{{$unity->name}}</td>
                            <td>{{$unity->description}}</td>
                            <td>
                                {{--@can('view',$unity)
                                <a href="{{route('admin.units.show',$unity)}}"
                                   class="btn btn-success"
                                ><i class="fa fa-eye"> Ver</i> </a>
                                @endcan--}}
                                {{--@can('update',$unity)--}}
                                <a href="{{route('admin.units.edit',$unity)}}"
                                   class="btn btn-info"
                                ><i class="fa fa-pencil"> Editar</i> </a>
                                {{--@endcan--}}
                                {{--@can('delete',$unity)--}}
                                <form method="POST"
                                      action="{{route('admin.units.destroy',$unity)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de querer eliminar ésta unidad?')"
                                    ><i class="fa fa-times"> Eliminar</i> </button>
                                </form>
                                {{--@endcan--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection