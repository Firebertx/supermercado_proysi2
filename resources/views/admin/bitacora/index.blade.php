@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            BITÁCORA
            {{--<small>Usuario</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">bitácora</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Registros de la Bitácora</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacora as $bitacor)
                        <tr>
                            <td> {{$bitacor->id}}</td>
                            <td> {{$bitacor->user}} {{$bitacor->last_name}}</td>
                            <td>{{$bitacor->action}}</td>
                            <td>{{$bitacor->date}}</td>
                            <td>{{$bitacor->hour}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection