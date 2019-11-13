@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            Productos del {{$combo->name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('admin.combos.index')}}"><i class="fa fa-linode"></i> Combos</a></li>
            <li class="active">Productos del {{$combo->name}}</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.combos.update', $combo)}}"
              enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('PUT')}}

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Datos del combo</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input name="name" value="{{old('name',$combo->name)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description', $combo->description)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="price">Precio:</label>
                                <input name="price" value="{{old('price', $combo->price)}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <label for="image">Imagen del combo:</label>
                            <div class="form-group">
                                <center>
                                @if(($combo->image)!="")
                                    <img width="250px" height="250px"  src="{{asset('images/combos/'.$combo->image)}}" >
                                @endif
                                </center>
                                <input type="file" name="image" value="{{$combo->image}}"class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Actualizar combo</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar' onclick="location.href = '{{ route('admin.combos.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection