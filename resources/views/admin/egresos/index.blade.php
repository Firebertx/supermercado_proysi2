@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Ventas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Egresos</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Ventas</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <p><a href="{{route('admin.inventories.index')}}"
                      class="btn btn-success"
                    ><i class="fa fa-eye"> Ver mis Inventarios</i> </a>
                </p>
                @can('create',new \App\Egreso())
                <p>
                    <a class="fa fa-plus btn btn-primary" href="{{route('admin.egresos.create')}}"> Registrar un Nuevo Egreso</a>
                </p>
                @endcan
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nº Venta</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Total</th>
                        <th>impuesto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($egresos as $egreso)
                        <tr>
                            <td> {{$egreso->purchase_number}}</td>
                            <td> {{$egreso->date}}</td>
                            <td> {{$egreso->customer->user->name}} {{$egreso->customer->user->last_name}} </td>
                            <td> {{$egreso->user->name}} {{$egreso->user->last_name}} </td>
                            <td> {{$egreso->total}}</td>
                            <td> {{$egreso->tax}}</td>
                            <td>
                                @if($egreso->state == "Registrado")
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
                                <a href="{{route('admin.egresos.show',$egreso)}}"
                                   class="btn btn-warning center-block"
                                ><i class="fa fa-eye"> Ver Detalles</i> </a>
                                {{--@endcan--}}

                                @if($egreso->state == "Registrado")
                                    <button type="button" class="btn btn-danger center-block" data-egreso_id="{{$egreso}}"
                                            data-toggle="modal" data-target="#cambiarEstadoVenta">
                                        <i class="fa fa-times"></i> Anular Venta
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

        <div class="modal fade" id="cambiarEstadoVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h4 class="modal-title">Cambiar Estado de Venta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.egresos.destroy',$egreso)}}" method="POST">
                            {{method_field('delete')}}  {{csrf_field()}}
                            <input type="hidden" id="egreso_id" name="egreso_id" value="">
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
