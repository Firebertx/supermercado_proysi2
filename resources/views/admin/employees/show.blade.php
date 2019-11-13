@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Perfil de Empleado
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">empleados</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('images/employees/'.$employee->user->photo)}}" alt="{{$employee->user->photo}}">
                    <h3 class="profile-username text-center">{{$employee->user->name}} {{$employee->user->last_name}}</h3>
                    <p class="text-muted text-center">{{$employee->user->getRoleNames()->implode(', ')}}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Código de trabajador</b> <a class="pull-right">{{$employee->code}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sexo</b> <a class="pull-right">{{$employee->user->sex}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nacionalidad</b> <a class="pull-right">{{$employee->user->nationality}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dirección</b> <a class="pull-right">{{$employee->user->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ciudad</b> <a class="pull-right">{{$employee->user->city}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Teléfono</b> <a class="pull-right">{{$employee->user->phone}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sucursal de Trabajo</b> <a class="pull-right">{{$employee->branchOffice->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{$employee->user->email}}</a>
                        </li>
                        @if($employee->user->roles->count())
                        <li class="list-group-item">
                            <b>Roles</b> <a class="pull-right">{{$employee->user->getRoleNames()->implode(', ')}}</a>
                        </li>
                        @endif
                    </ul>
                    @can('update', new App\Employee())
                    <a href="{{route('admin.employees.edit',$employee)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @forelse($employee->user->roles as $role)
                        <strong>{{$role->name}}</strong>
                        @if($role->permissions->count())
                            <br>
                            <small class="text-muted">
                                Permisos:{{$role->permissions->pluck('name')->implode(', ')}}
                            </small>
                        @endif
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene ningún role asignado</small>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos Adicionales</h3>
                </div>
                <div class="box-body">
                    @forelse($employee->user->permissions as $permissions)
                        <strong>{{$permissions->name}}</strong>
                        @unless($loop->last)
                            <hr>
                        @endunless
                    @empty
                        <small class="text-muted">No tiene permisos adicionales</small>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
@endsection