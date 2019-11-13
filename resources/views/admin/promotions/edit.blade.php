@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos con el {{$promotion->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.promotions.index')}}"><i class="fa fa-linode"></i> Promociones</a></li>
            <li class="active">Productos con el {{$promotion->name}}</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.promotions.update', $promotion)}}"
              enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('PUT')}}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Datos de la promoción</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input name="name" value="{{old('name',$promotion->name)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="percentage">Porcentaje:</label>
                                <span>(Ej: 0.10, 0.15, 0.50, 1)</span>
                                <input name="percentage" value="{{old('percentage', $promotion->percentage)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description', $promotion->description)}}" class="form-control">
                            </div>

                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <label for="image">Imagen de la promoción:</label>
                            <div class="form-group">
                                <center>
                                    @if(($promotion->image)!="")
                                        <img width="250px" height="250px"  src="{{asset('images/promotions/'.$promotion->image)}}" >
                                    @endif
                                </center>
                                <input type="file" name="image" value="{{$promotion->image}}"class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Actualizar promoción</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar' onclick="location.href = '{{ route('admin.promotions.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection