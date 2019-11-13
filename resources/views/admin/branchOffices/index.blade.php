@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Sucursales
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">sucursales</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <!-- DataTables -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Sucursales</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                @can('create',new App\BranchOffice())
                <p>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.branchOffices.create')}}">Crear Sucursal</a>
                </p>
                @endcan
                <table class="table table-striped table-bordered table-condensed table-hover" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class="col-md-3">Imagen</th>
                    <th>Dirección</th>
                    <th>Ubicación</th>
                    <th class="col-md-3">Acciones</th>
                    </thead>
                    @foreach($branchOffices as $branchOffice)
                        <tr>
                            <td class=" text-center " >{{$branchOffice->id}}</td>
                            <td>
                                <h3 class=" text-center " >{{$branchOffice->name}}</h3>
                            </td>
                            <td>
                                <img height="150px" width="150px" class="img-thumbnail center-block" src="{{Storage::url($branchOffice->image)}}">
                            </td>
                            <td class=" text-center " >{{$branchOffice->address}}</td>
                            <td>
                                <center>
                                    @can('view',$branchOffice)
                                        <a href="{{route('admin.branchOffices.show',$branchOffice)}}"
                                           class="btn btn-success"
                                        ><i class="fa fa-eye"> Ver Mapa</i> </a>
                                    @endcan
                                </center>
                            </td>
                            <td>
                                <center>
                                @can('update',$branchOffice)
                                    <a href="{{route('admin.branchOffices.edit',$branchOffice)}}"
                                       class="btn btn-info"
                                    ><i class="fa fa-pencil"> Editar</i></a>
                                @endcan

                                @can('delete',$branchOffice)
                                    <form method="POST"
                                          action="{{route('admin.branchOffices.destroy',$branchOffice)}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar ésta sucursal?')"
                                        ><i class="fa fa-times"> Eliminar</i></button>
                                    </form>
                                @endcan
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection