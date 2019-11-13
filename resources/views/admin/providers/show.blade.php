@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Perfil de Proveedor
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">proveedores</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('images/providers/'.$provider->user->photo)}}" alt="{{$provider->user->photo}}">
                    <h3 class="profile-username text-center">{{$provider->user->name}} {{$provider->user->last_name}}</h3>
                    <p class="text-muted text-center">{{$provider->nit}}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>NIT del proveedor</b> <a class="pull-right">{{$provider->nit}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sexo</b> <a class="pull-right">{{$provider->user->sex}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nacionalidad</b> <a class="pull-right">{{$provider->user->nationality}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dirección</b> <a class="pull-right">{{$provider->user->address}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ciudad</b> <a class="pull-right">{{$provider->user->city}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Teléfono</b> <a class="pull-right">{{$provider->user->phone}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{$provider->user->email}}</a>
                        </li>
                        @if($provider->user->roles->count())
                            <li class="list-group-item">
                                <b>Rol</b> <a class="pull-right">{{$provider->user->getRoleNames()->implode(', ')}}</a>
                            </li>
                        @endif
                    </ul>
                    @can('update', new App\Provider())
                        <a href="{{route('admin.providers.edit',$provider)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Productos Suministrados</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($detalleIngresos as $detalleIngreso)
                            @if($detalleIngreso->ingreso->provider_id === $provider->id)
                                <tr>
                                    <td>
                                        <img class="profile-user-img img-responsive img-circle" src="{{Storage::url($detalleIngreso->product->image)}}">
                                    </td>
                                    <td>{{$detalleIngreso->product->name}}</td>
                                    <td>{{$detalleIngreso->quantity}}</td>
                                    <td>{{$detalleIngreso->price}}</td>
                                    <td>{{$detalleIngreso->date}}</td>
                                </tr>
                            @endif
                        @empty
                            <small class="text-muted">No ha sumintrado ningún producto</small>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection