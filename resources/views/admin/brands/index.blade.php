@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Marcas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">marcas</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <!-- DataTables -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Marcas</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\Brand())
                    <p>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.brands.create')}}">Crear Marca</a>
                    </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th>Id</th>
                    <th class="col-md-2">Nombre</th>
                    <th class="col-md-3">Descripción</th>
                    <th class="col-md-4">Imagen</th>
                    <th class="col-md-3">Opciones</th>
                    </thead>
                    @foreach($brands as $brand)
                        <tr>
                            <td><h1 class=" text-center " >{{$brand->id}}</h1></td>
                            <td>
                                <h1 class=" text-center " >{{$brand->name}}</h1>
                            </td>
                            <td>
                                    <h4 class=" text-center " >{{$brand->description}}</h4>
                            </td>
                            <td>
                                <img height="150px" width="200px" class="img-thumbnail center-block" src="{{Storage::url($brand->logo)}}">
                            </td>

                            <td>
                            {{--@can('view',$brand)
                                    <a href="{{route('admin.brands.show',$brand)}}"
                                       class="btn btn-success center-block"
                                    ><i class="fa fa-eye"> Ver</i> </a>
                            @endcan--}}
                            {{--@can('update',$brand)--}}
                                <a href="{{route('admin.brands.edit',$brand)}}"
                                   class="btn btn-info center-block col-md-6"
                                ><i class="fa fa-pencil"> Editar</i></a>
                            {{--@endcan--}}
                            {{--@can('delete',$brand)--}}
                                <form method="POST"
                                      action="{{route('admin.brands.destroy',$brand)}}"
                                      style="display: inline">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-danger center-block "
                                            onclick="return confirm('¿Estás seguro de querer eliminar éste producto?')"
                                    ><i class="fa fa-times"> Eliminar</i></button>
                                </form>
                            {{--@endcan--}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection