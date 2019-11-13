@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Permisos
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">permisos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Permisos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>{{--<tr>=Por cada user crear una fila--}}
                            <td> {{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{--acciones para editar mi user a.btn.btn-info--}}
                                @can('update',$permission)
                                    <a href="{{route('admin.permissions.edit',$permission)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil"> Editar</i> </a>
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