@extends('admin.layout')

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.categories.store')}}"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Datos de la categoria</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="image">Imagen de la categoría:</label>
                                <input type="file" name="image" value="{{$category->image}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <input name="name" value="{{old('name')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input name="description" value="{{old('description')}}" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Crear categoria</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar' onclick="location.href = '{{ route('admin.categories.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection