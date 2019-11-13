@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Inventarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">inventarios</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Inventarios</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create', new App\Inventory())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.inventories.create')}}">Crear Inventario</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Inventario</th>
                        <th>Almacén</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td> {{$inventory->id}}</td>
                            <td>{{$inventory->name}}</td>
                            <td>
                                {{$inventory->warehouse->name}}
                            </td>
                            <td>{{$inventory->description}}</td>
                            <td>
                                <center>
                                    @can('view',$inventory)
                                        <a href="{{route('admin.inventories.show',$inventory)}}"
                                           class="btn btn-success"
                                        ><i class="fa fa-eye"> Ver Productos</i> </a>
                                    @endcan
                                </center>
                            </td>
                            <td>
                            @can('update',$inventory)
                                <a href="{{route('admin.inventories.edit', $inventory)}}"
                                   class="btn btn-info"
                                ><i class="fa fa-pencil"> Editar</i> </a>
                            @endcan
                            @can('delete',$inventory)
                                <form method="POST"
                                      action="{{route('admin.inventories.destroy',$inventory)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de querer eliminar ésta inventario?')"
                                    ><i class="fa fa-times"> Eliminar</i> </button>
                                </form>
                            @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection