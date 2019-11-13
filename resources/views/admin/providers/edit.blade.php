@extends('admin.layout')

@section('contenedor')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST"
                          action="{{route('admin.users.update', $provider->user->id)}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}    {{method_field('PUT')}}

                        <img width="100px" src="{{asset('images/providers/'.$provider->user->photo)}}" >
                        <div class="form-group">
                            <label for="photo">Foto de Perfil:</label>
                            <input type="file" name="photo" value="{{old('photo', $provider->user->photo)}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{old('name', $provider->user->name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input name="last_name" value="{{old('last_name', $provider->user->last_name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nacionalidad:</label>
                            <input name="nationality" value="{{old('nationality', $provider->user->nationality)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input name="address" value="{{old('address', $provider->user->address)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input name="phone" value="{{old('phone', $provider->user->phone)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sexo:</label>
                            <input name="sex" value="{{old('sex', $provider->user->sex)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{old('email', $provider->user->email)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                            <span class="help-block">Dejar en blanco si no desea cambiar la contraseña</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repetir contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Repetir la contraseña">
                        </div>

                        <button class="btn btn-primary btn-block">Actualizar datos personales del proveedor</button>

                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del proveedor</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{route('admin.providers.update', $provider)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="nit">NIT del proveedor:</label>
                            <input name="nit" value="{{ $provider->nit }}" class="form-control">
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar información del proveedor</button>
                    </form>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @role('Administrador')
                    <form method="POST" action="{{route('admin.users.roles.update', $provider->user)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        @include('admin.roles.checkboxes',['model'=>$provider->user])
                        <button class="btn btn-primary btn-block">Actualizar roles</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($provider->user->roles as $role)
                                <li class="list-group-item">{{$role->name}}</li>
                            @empty
                                <li class="list-group-item">No tiene role</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>

        </div>
    </div>
@endsection