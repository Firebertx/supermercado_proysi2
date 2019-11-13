@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Edición de la promoción {{$event->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.promociones.index')}}"><i class="fa fa-universal-access"></i> Promociones</a></li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.promociones.update', $event)}}"
              enctype="multipart/form-data">
            {{csrf_field()}}    {{method_field('PUT')}}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">


                        <div class="box-header with-border">
                            <h3 class="box-title">Combos de la promoción</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <label for="image">Imagen del producto:</label>
                            <h1>{{$event->id}}</h1>
                            <h1>{{$event->name}}</h1>

                            <div class="form-group">
                                <center>
                                    <img width="150px" height="150" src="{{Storage::url($event->image)}}">
                                </center>
                                <input type="file" name="image" value="{{$event->image}}"class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" value="{{old('name', $event->name)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description', $event->description)}}" class="form-control">
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
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar Edición' onclick="location.href = '{{ route('admin.promociones.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection