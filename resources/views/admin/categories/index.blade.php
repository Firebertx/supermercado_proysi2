@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Categorías
            {{--<small>Categoría</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">categorías</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Categorías</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Category())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.categories.create')}}">Crear Categoría</a>
                    </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">Nombre</th>
                        <th class="col-md-3">Imagen</th>
                        <th class="col-md-3">Descripción</th>
                        <th class="col-md-3">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td> {{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                <center><img height="200px" width="200px" class="img-thumbnail" src="{{Storage::url($category->image)}}"></center>
                            </td>
                            <td>{{$category->description}}</td>
                            <td>
                            {{--@can('view',$category)
                                <a href="{{route('admin.categories.show',$category)}}"
                                   class="btn btn-success"
                                ><i class="fa fa-eye"> Ver</i> </a>
                            @endcan--}}
                            {{--@can('update',$category)--}}
                                <a href="{{route('admin.categories.edit',$category)}}"
                                   class="btn btn-info"
                                ><i class="fa fa-pencil"> Editar</i> </a>
                            {{--@endcan--}}
                            {{--@can('delete',$category)--}}
                                <form method="POST"
                                      action="{{route('admin.categories.destroy',$category)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de querer eliminar ésta categoría?')"
                                    ><i class="fa fa-times"> Eliminar</i> </button>
                                </form>
                            {{--@endcan--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection