@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Promociones
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Promociones</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Promociones</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Promotion())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.promotions.create')}}">Crear Promoción</a>
                    </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th class="col-md-2">Imagen</th>
                    <th class="col-md-2">Nombre</th>
                    <th>Porcentaje</th>
                    <th class="col-md-3">Descripción</th>
                    <th class="col-md-5">Acciones</th>
                    </thead>
                    @foreach($promotions as $promotion)
                        <tr>
                            <td>
                                <center>
                                    <img height="150px" width="150px" class="img-thumbnail" src="{{asset('images/promotions/'.$promotion->image)}}" alt="{{$promotion->image}}">
                                </center>
                            </td>
                            <td>{{$promotion->name}}</td>
                            <td>{{$promotion->percentage}}%</td>
                            <td>{{$promotion->description}}</td>
                            <td>
                                @can('view',$promotion)
                                    <a href="{{route('admin.promotions.show',$promotion)}}"
                                       class="btn btn-success"
                                    ><i class="fa fa-eye">Ver productos</i> </a>
                                @endcan
                                @can('update',$promotion)
                                    <a href="{{route('admin.promotions.edit',$promotion)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil">Editar Promoción</i> </a>
                                @endcan
                                @can('delete',$promotion)
                                    <form method="POST"
                                          action="{{route('admin.promotions.destroy',$promotion)}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar ésta promoción?')"
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