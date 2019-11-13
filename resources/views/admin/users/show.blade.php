@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Perfil de Usuario
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">usuarios</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{Storage::url($user->photo)}}" alt="{{$user->name}}">
                    <h3 class="profile-username text-center">{{$user->name}} {{$user->last_name}}</h3>
                    <p class="text-muted text-center">{{$user->getRoleNames()->implode(', ')}}</p>
                    <ul class="list-group list-group-unbordered">
                        @if(!$user->hasRole('Cliente'))
                            <li class="list-group-item">
                                <b>Código de trabajador</b> <a class="pull-right">{{$user->code}}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>Sexo</b> <a class="pull-right">{{$user->sex}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nacionalidad</b> <a class="pull-right">{{$user->nationality}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dirección</b> <a class="pull-right">{{$user->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Teléfono</b> <a class="pull-right">{{$user->phone}}</a>
                        </li>

                        @if(!$user->hasRole('Cliente'))
                            <li class="list-group-item">
                                <b>Sucursal de Trabajo</b> <a class="pull-right">
                                    @if($user->branchOffice_id == NULL)
                                    @else
                                        {{$user->branchOffice->name}}
                                    @endif
                                </a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{$user->email}}</a>
                        </li>
                        @if($user->roles->count())
                        <li class="list-group-item">
                            <b>Roles</b> <a class="pull-right">{{$user->getRoleNames()->implode(', ')}}</a>
                        </li>
                        @endif
                    </ul>
                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @forelse($user->roles as $role)
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
                    @forelse($user->permissions as $permissions)
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