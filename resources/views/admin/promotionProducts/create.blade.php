@extends('admin.layout')

@section('contenedor')
    <div class="box box-primary">
        @include('admin.partials.error-messages')
        <form method="POST"
              action="{{route('admin.promotions_products.store')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <div class="box-body">

                        <div class="box-header with-border">
                            <h3 class="box-title">Producto ha añadir</h3>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label>Promoción:</label>
                                <select name="promotion" class="form-control">
                                    <option value="">Selecciona una promoción</option>
                                    @foreach($promotions as $promotion)
                                        <option value="{{$promotion->id}}"> {{$promotion->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label>Producto:</label>
                                <select name="product" class="form-control">
                                    <option value="">Selecciona un producto</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label for="quantity">Cantidad: </label>
                                <input name="quantity" value="{{old('quantity')}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="date" value="{{old('date')}}" type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <div class="box-body">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <button class="btn btn-primary btn-block">Añadir producto</button>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <input type ='button' class="btn btn-danger btn-block"  value = 'Cancelar' onclick="location.href = '{{ route('admin.promotions.index') }}'"/>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection

@push('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adm/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adm/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
    <!-- Select2 -->
    <script src="/adm/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- CK Editor -->
    <script src="/adm/bower_components/ckeditor/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <script src="/adm/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('.select2').select2();
        CKEDITOR.replace('editor')
    </script>
@endpush