@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">clientes</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Clientes</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Customer)
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.customers.create')}}">Crear Cliente</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            @if(auth()->user()->type === 'Cliente' and $customer->user_id===auth()->id() or auth()->user()->type === 'Empleado')
                            <tr>
                                <td> {{$customer->user->id}}</td>
                                <td>{{$customer->user->name}}</td>
                                <td>{{$customer->user->last_name}}</td>
                                <td>{{$customer->user->email}}</td>
                                <td>{{$customer->user->phone}}</td>
                                <td>{{$customer->city}}</td>
                                <td>{{$customer->user->address}}</td>
                                <td>
                                    @can('view',new App\Customer)
                                        <a href="{{route('admin.customers.show',$customer)}}"
                                           class="btn btn-xs btn-default"
                                        ><i class="fa fa-eye"></i> </a>
                                    @endcan
                                    @can('update',new App\Customer)
                                        <a href="{{route('admin.customers.edit',$customer)}}"
                                           class="btn btn-xs btn-info"
                                        ><i class="fa fa-pencil"></i> </a>
                                    @endcan
                                    @can('delete',new App\Customer)
                                        <form method="POST"
                                              action="{{route('admin.customers.destroy',$customer)}}"
                                              style="display: inline">
                                              {{csrf_field()}} {{method_field('DELETE')}}
                                              <button class="btn btn-xs btn-danger"
                                                      onclick="return confirm('¿Estás seguro de querer eliminar éste cliente?')"
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