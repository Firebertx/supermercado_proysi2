@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Roles
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">roles</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Roles</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',$roles->first())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.roles.create')}}">Crear nuevo Rol</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="col-md-6">Permisos</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>{{--<tr>=Por cada user crear una fila--}}
                            <td> {{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->permissions->pluck('name')->implode(', ')}}</td>
                            <td>{{--acciones para editar mi user a.btn.btn-info--}}
                                @can('update',$role)
                                    <a href="{{route('admin.roles.edit',$role)}}"
                                       class="btn btn-xs btn-info"
                                    ><i class="fa fa-pencil"></i> </a>
                                @endcan
                                @can('delete',$role)
                                    @if($role->id!==1)
                                        <form method="POST"
                                              action="{{route('admin.roles.destroy',$role)}}"
                                              style="display: inline">
                                            {{csrf_field()}} {{method_field('DELETE')}}
                                            <button class="btn btn-xs btn-danger"
                                                    onclick="return confirm('¿Estás seguro de querer eliminar éste role?')"
                                            ><i class="fa fa-times"></i> </button>
                                        </form>
                                    @endif
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