@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            {{$inventory->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.inventories.index')}}"><i class="fa fa-building-o"></i> Inventarios</a></li>
            <li class="active">Modificación del {{$inventory->name}}</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.inventories.update', $inventory)}}"
              enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('PUT')}}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Datos del inventario</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input name="name" value="{{old('name',$inventory->name)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="warehouse">Almacen: </label>
                                <select name="warehouse" class="form-control">
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{old('id',$warehouse->id)}}">{{$warehouse->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description', $inventory->description)}}" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Actualizar inventario</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar' onclick="location.href = '{{ route('admin.inventories.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection