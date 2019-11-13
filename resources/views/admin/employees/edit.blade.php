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
                          action="{{route('admin.users.update', $employee->user->id)}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}    {{method_field('PUT')}}

                        <img width="100px" src="{{asset('images/employees/'.$employee->user->photo)}}" >
                        <div class="form-group">
                            <label for="photo">Foto de Perfil:</label>
                            <input type="file" name="photo" value="{{$employee->user->photo}}"class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{old('name', $employee->user->name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input name="last_name" value="{{old('last_name', $employee->user->last_name)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nacionalidad:</label>
                            <input name="nationality" value="{{old('nationality', $employee->user->nationality)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input name="address" value="{{old('address', $employee->user->address)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input name="phone" value="{{old('phone', $employee->user->phone)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sexo:</label>
                            <input name="sex" value="{{old('sex', $employee->user->sex)}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{old('email', $employee->user->email)}}" class="form-control">
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

                        <button class="btn btn-primary btn-block">Actualizar datos personales del empleado</button>

                    </form>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Información de trabajo</h3>
                </div>
                <div class="box-body">
                    @include('admin.partials.error-messages')
                    <form method="POST" action="{{route('admin.employees.update', $employee)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="code">Código de trabajador:</label>
                            <input name="code" value="{{ $employee->code }}" class="form-control">
                        </div>
                        @role('Administrador')
                        <div class="form-group">
                            <label>Sucursal de Trabajo:</label>
                            <select name="branchOffice" class="form-control">
                                <option value="">Selecciona una sucursal</option>
                                @foreach($branchOffices as $branchOffice)
                                    <option value="{{$branchOffice->id}}"
                                            {{old('branchOffice',$employee->branchOffice_id)== $branchOffice->id ? 'selected':''}}
                                    >{{$branchOffice->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                            <div class="form-group">
                                <label>Sucursal de Trabajo:</label>
                                <input disabled value="{{$employee->branchOffice->name}}" class="form-control">
                            </div>
                        @endrole

                        <button class="btn btn-primary btn-block">Actualizar información del trabajador</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @role('Administrador')
                    <form method="POST" action="{{route('admin.users.roles.update', $employee->user)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        @include('admin.roles.checkboxes',['model'=>$employee->user])
                        <button class="btn btn-primary btn-block">Actualizar roles</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($employee->user->roles as $role)
                                <li class="list-group-item">{{$role->name}}</li>
                                @empty
                                    <li class="list-group-item">No tiene role</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos</h3>
                </div>
                <div class="box-body">
                    @role('Administrador')
                    <form method="POST" action="{{route('admin.users.permissions.update', $employee->user)}}">
                        {{csrf_field()}}    {{method_field('PUT')}}
                        @include('admin.permissions.checkboxes',['model'=>$employee->user])
                        <button class="btn btn-primary btn-block">Actualizar permisos</button>
                    </form>
                    @else
                        <ul class="list-group">
                            @forelse($employee->user->permissions as $permission)
                                <li class="list-group-item">{{$permission->name}}</li>
                            @empty
                                <li class="list-group-item">No tiene permisos</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>

    </div>
@endsection