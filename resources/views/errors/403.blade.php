@extends('admin.layout')

@section('contenedor')
    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Página no autorizada</h1>
            {{$exception->getMessage()}}
            <p>Regresar a <a href="{{url()->previous()}}">pagina anterior</a></p>
        </div>
    </section>
@endsection
