@extends('admin.layout')

@section('contenedor')
    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Pagina no encontrada</h1>
            <p>Regresar a <a href="{{url()->previous()}}">Inicio</a></p>
        </div>
    </section>
@endsection
