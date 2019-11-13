@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Combos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Combos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Combos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Package())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.packages.create')}}">Crear Combo</a>
                    </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th class="col-md-3">Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio(Bs)</th>
                    <th class="col-md-4">Acciones</th>
                    </thead>
                    @foreach($packages as $package)
                        <tr>
                            <td>
                                <center>
                                    <img height="150px" width="150px" class="img-thumbnail" src="{{Storage::url($package->image)}}">
                                </center>
                            </td>
                            <td>{{$package->name}}</td>
                            <td>{{$package->description}}</td>
                            <td class="text-center">{{$package->price}}</td>
                            <td>
                                @can('view',$package)
                                    <a href="{{route('admin.packages.show',$package)}}"
                                       class="btn btn-success"
                                    ><i class="fa fa-eye">Ver productos</i> </a>
                                @endcan
                                @can('update',$package)
                                    <a href="{{route('admin.packages.edit',$package)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil">Editar Combo</i> </a>
                                @endcan
                                @can('delete',$package)
                                    <form method="POST"
                                          action="{{route('admin.packages.destroy',$package)}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar éste combo?')"
                                        ><i class="fa fa-times">Eliminar</i></button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection