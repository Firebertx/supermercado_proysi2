@extends('admin.layout')

@section('header')
    <section class="content-header">
        <h1>
            BACKUP
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">backup</li>
        </ol>
    </section>
@endsection

@section('contenedor')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Copia de seguridad de la Base de datos</h3>
        </div>

        <div class="panel-heading">
            <a id="create-new-backup-button" href="{{route('admin.backup.create')}}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Crear Nuevo Backup
            </a>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="posts-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($backups as $key => $backup)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $backup['file_name'] }}</td>
                                <td>{{ ($backup['file_size']) }}</td>
                                <td>{{ $backup['last_modified'] }}</td>
                                <td style="width: 200px;">
                                    <a href="{{route('admin.backup.show', $backup['file_name']) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-cloud-download"></i> Descargar</a>
                                    <form method="POST"
                                          action="{{route('admin.backup.destroy', $backup['file_name'])}}"
                                          style="display: inline">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de querer eliminar ésto?')"
                                        ><i class="fa fa-trash-o"> Eliminar</i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
