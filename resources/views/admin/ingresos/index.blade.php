@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Ingresos de Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">ingresos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Ingresos</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <p><a href="{{route('admin.inventories.index')}}"
                      class="btn btn-success"
                    ><i class="fa fa-eye"> Ver mis Inventarios</i> </a>
                </p>
                @can('create',new App\Ingreso())
                <p>
                    <a class="fa fa-plus btn btn-primary" href="{{route('admin.ingresos.create')}}"> Registrar un Nuevo Ingreso</a>
                </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nº Compra</th>
                        <th>Proveedor</th>
                        <th>Comprador</th>
                        <th>Inventario</th>
                        <th>Total (Bs.)</th>
                        <th>impuesto (Bs.)</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingresos as $ingreso)
                        <tr>
                            <td> {{$ingreso->purchase_number}}</td>
                            <td> {{$ingreso->provider->user->name}} {{$ingreso->provider->user->last_name}}</td>
                            <td> {{$ingreso->user->name}} {{$ingreso->user->last_name}} </td>
                            <td> {{$ingreso->inventory->name}}</td>
                            <td> {{$ingreso->total}}</td>
                            <td> {{$ingreso->tax}}</td>
                            <td> {{$ingreso->date}}</td>
                            <td>
                                @if($ingreso->state == "Registrado")
                                    <button type="button" class="btn btn-success btn-md">
                                        <i class="fa fa-check"></i> Registrado
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger btn-md">
                                        <i class="fa fa-check"></i> Anulado
                                    </button>
                                @endif
                            </td>
                            <td>
                                {{--@can('view',$product)--}}
                                <a href="{{route('admin.ingresos.show',$ingreso)}}"
                                   class="btn btn-warning center-block"
                                ><i class="fa fa-eye"> Ver Detalles</i> </a>
                                {{--@endcan--}}

                                @if($ingreso->state == "Registrado")
                                    <button type="button" class="btn btn-danger center-block" data-ingreso_id="{{$ingreso}}"
                                            data-toggle="modal" data-target="#cambiarEstadoCompra">
                                        <i class="fa fa-times"></i> Anular Compra
                                    </button>
                                @else
                                    <button type="button" class="col-md-12 btn btn-success center-block">
                                        <i class="fa fa-lock"></i> Anulado
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="cambiarEstadoCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h4 class="modal-title">Cambiar Estado de Compra</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.ingresos.destroy',$ingreso)}}" method="POST">
                            {{method_field('delete')}}  {{csrf_field()}}
                            <input type="hidden" id="ingreso_id" name="ingreso_id" value="">
                            <p>¿Estás seguro de cambiar el estado?</p>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
