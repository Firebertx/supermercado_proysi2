@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            EMPLEADOS
            {{--<small>Empleados</small--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">empleados</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <!-- DataTables -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de empledos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create', new App\Employee())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.employees.create')}}">Crear Empleado</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Sucursal</th>
                            @can('view', new App\Employee())
                            <th>Acciones</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td> {{$employee->code}}</td>
                                <td>{{$employee->user->name}}</td>
                                <td>{{$employee->user->last_name}}</td>
                                <td>{{$employee->user->email}}</td>
                                <td>{{$employee->user->getRoleNames()->implode(', ')}}</td>
                                <td>{{$employee->branchOffice->name}}</td>
                                <td>
                                    @can('view',$employee)
                                        <a href="{{route('admin.employees.show',$employee)}}"
                                           class="btn btn-xs btn-default"
                                        ><i class="fa fa-eye"></i> </a>
                                    @endcan
                                    @can('update',$employee)
                                        <a href="{{route('admin.employees.edit',$employee)}}"
                                           class="btn btn-xs btn-info"
                                        ><i class="fa fa-pencil"></i> </a>
                                    @endcan
                                    @can('delete',$employee)
                                        <form method="POST"
                                              action="{{route('admin.employees.destroy',$employee)}}"
                                              style="display: inline">
                                              {{csrf_field()}} {{method_field('DELETE')}}
                                              <button class="btn btn-xs btn-danger"
                                                      onclick="return confirm('¿Estás seguro de querer eliminar éste empleado?')"
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