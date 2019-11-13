@extends('admin.layout')

@section('contenedor')
        <div class="box box-primary">
            @include('admin.partials.error-messages')
            <form method="POST" action="{{route('admin.users.store')}}">
                {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Personales</h3>
                        </div>

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" value="{{old('name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellido:</label>
                                <input name="last_name" value="{{old('last_name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sex">Sexo:</label>
                                <input name="sex" value="{{old('sex')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nationality">Nacionalidad:</label>
                                <input name="nationality" value="{{old('nationality')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad:</label>
                                <input name="city" value="{{old('city')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input name="address" value="{{old('address')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input name="phone" value="{{old('phone')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" value="{{old('email')}}" class="form-control">
                            </div>

                        <div class="box-body">
                            <div class="box-header with-border">
                                <h3 class="box-title">Datos del empleado</h3>
                                </br>
                                <span>Nota: Solo para registrar empleados</span>
                            </div>
                            <div class="form-group">
                                <label for="code">Código de trabajador:</label>
                                <input name="code" value="{{old('code')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sucursal de Trabajo:</label>
                                <select name="branchOffice" class="form-control">
                                    <option value="">Selecciona una sucursal</option>
                                    @foreach($branchOffices as $branchOffice)
                                        <option value="{{$branchOffice->id}}">{{$branchOffice->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="box-header with-border ">
                                <h3 class="box-title ">Datos del proveedor</h3>
                                </br>
                                <span>NOTA: Solo para registrar proveedores</span>
                            </div>
                            <div class="form-group">
                                <label for="nit">NIT: </label>
                                <input name="nit" value="{{old('nit')}}" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    @include('admin.roles.checkboxes',['model'=>$user])
                    {{--@include('admin.roles.checkboxes')--}}
                    <div class="box-header with-border">
                        <h3 class="box-title">Permisos</h3>
                    </div>
                    @include('admin.permissions.checkboxes',['model'=>$user])
                </div>
            </div>
            <button class="btn btn-primary btn-block">Crear usuario</button>
            </form>
        </div>
        </div>
@endsection