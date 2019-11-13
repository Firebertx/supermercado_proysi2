@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Proveedores
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">proveedores</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Proveedores</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Provider)
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.providers.create')}}">Crear Proveedor</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIT</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($providers as $provider)
                            @if(auth()->user()->type === 'Proveedor' and $provider->user_id===auth()->id() or auth()->user()->type === 'Empleado')
                            <tr>
                                <td> {{$provider->nit}}</td>
                                <td>{{$provider->user->name}}</td>
                                <td>{{$provider->user->last_name}}</td>
                                <td>{{$provider->user->address}}</td>
                                <td>{{$provider->user->email}}</td>
                                <td>{{$provider->user->phone}}</td>
                                <td>{{$provider->user->city}}</td>
                                <td>
                                    @can('view',$provider)
                                        <a href="{{route('admin.providers.show',$provider)}}"
                                           class="btn btn-xs btn-default"
                                        ><i class="fa fa-eye"></i> </a>
                                    @endcan
                                    @can('update',$provider)
                                        <a href="{{route('admin.providers.edit',$provider)}}"
                                           class="btn btn-xs btn-info"
                                        ><i class="fa fa-pencil"></i> </a>
                                    @endcan
                                    @can('delete',$provider)
                                        <form method="POST"
                                              action="{{route('admin.providers.destroy',$provider)}}"
                                              style="display: inline">
                                              {{csrf_field()}} {{method_field('DELETE')}}
                                              <button class="btn btn-xs btn-danger"
                                                      onclick="return confirm('¿Estás seguro de querer eliminar éste proveedor?')"
                                              ><i class="fa fa-times"></i> </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection