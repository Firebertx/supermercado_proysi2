@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            USUARIOS
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">usuarios</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <!-- DataTables -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Usuarios</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',$users->first())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.users.create')}}">Crear Usuario</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Sucursal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>{{--<tr>=Por cada user crear una fila--}}
                                <td> {{$user->id}}</td>
                                <td> {{$user->code}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getRoleNames()->implode(', ')}}</td>
                                <td>@if($user->branchOffice_id == NULL)
                                    @else
                                        {{$user->branchOffice->name}}
                                    @endif
                                </td>
                                <td>
                                    @can('view',$user)
                                        <a href="{{route('admin.users.show',$user)}}"
                                           class="btn btn-xs btn-default"
                                                {{--target="_blank" //para abrir en otra pestaña--}}
                                        ><i class="fa fa-eye"></i> </a>
                                    @endcan
                                    @can('update',$user)
                                        <a href="{{route('admin.users.edit',$user)}}"
                                           class="btn btn-xs btn-info"
                                        ><i class="fa fa-pencil"></i> </a>
                                    @endcan
                                    @can('delete',$user)
                                        <form method="POST"
                                              action="{{route('admin.users.destroy',$user)}}"
                                              style="display: inline">
                                              {{csrf_field()}} {{method_field('DELETE')}}
                                              <button class="btn btn-xs btn-danger"
                                                      onclick="return confirm('¿Estás seguro de querer eliminar éste usuario?')"
                                              ><i class="fa fa-times"></i> </button>
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