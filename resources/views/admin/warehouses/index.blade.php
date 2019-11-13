@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Almacenes
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">almacenes</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Almacenes</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create', new App\Warehouse())
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.warehouses.create')}}">Crear Almacén</a>
                </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ubicación</th>
                    <th class="col-md-3">Acciones</th>
                    </thead>
                    @foreach($warehouses as $warehouse)
                        <tr>
                            <td>{{$warehouse->id}}</td>
                            <td>{{$warehouse->name}}</td>
                            <td>{{$warehouse->location}}</td>
                            <td>
                                <center>
                                    @can('view',$warehouse)
                                        <a href="{{route('admin.warehouses.show',$warehouse)}}"
                                           class="btn btn-success"
                                        ><i class="fa fa-eye"> Ver Mapa</i> </a>
                                    @endcan
                                </center>
                            </td>
                            <td>
                                <center>
                                    @can('update',$warehouse)
                                    <a href="{{route('admin.warehouses.edit',$warehouse)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil"> Editar</i></a>
                                    @endcan
                                    @can('delete',$warehouse)
                                    <form method="POST"
                                          action="{{route('admin.warehouses.destroy',$warehouse)}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar éste producto?')"
                                        ><i class="fa fa-times"> Eliminar</i></button>
                                    </form>
                                    @endcan
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection