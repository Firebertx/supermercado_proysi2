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
                @can('create', new App\Combo())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.combos.create')}}">Crear Combo</a>
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
                    @foreach($combos as $combo)
                        <tr>
                            <td>
                                <center>
                                    <img height="150px" width="150px" class="img-thumbnail" src="{{asset('images/combos/'.$combo->image)}}" alt="{{$combo->image}}">
                                </center>
                            </td>
                            <td>{{$combo->name}}</td>
                            <td>{{$combo->description}}</td>
                            <td class="text-center">
                                {{$combo->price}}
                            </td>
                            <td>
                                @can('view',$combo)
                                    <a href="{{route('admin.combos.show',$combo)}}"
                                       class="btn btn-success"
                                    ><i class="fa fa-eye">Ver productos</i> </a>
                                @endcan
                                @can('update',$combo)
                                    <a href="{{route('admin.combos.edit',$combo)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil">Editar Combo</i> </a>
                                @endcan
                                @can('delete',$combo)
                                    <form method="POST"
                                          action="{{route('admin.combos.destroy',$combo)}}"
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