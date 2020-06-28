@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
    <div class="row">
        <div class="mr-auto form-inline mt-3">
           @can('proyectos.create') <a class="btn btn-primary" href="{{ route('proyectos.create') }}">Nuevo proyecto</a> @endcan
        </div>
    </div>

    <div class="row pt-5">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="text-center">
                    @include('usuarios.fragment.info')
                    <table id="proyectosTable" class="table table-hover table-striped" data-maintain-meta-data="true">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="row">Nombre del proyecto</th>
                                <th scope="row">Descripción</th>
                                <th scope="row">Fecha de Inicio</th>
                                <th scope="row">Fecha Final</th>
                                <th scope="row">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->nombre}}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td>{{ $item->fecha_inicio }}</td>
                                <td>{{ $item->fecha_final }}</td>
                                <td class="form-inline">
                                    @can('proyectos.edit')<a class="btn btn-primary btn-sm" href="{{ route('proyectos.edit',$item->id) }}">Editar datos</a>
                                    @endcan
                                    &nbsp
                                   <!-- @can('proyectos.destroy')
                                    {!! Form::open(['route'=>['proyectos.destroy',$item->id],'method'=>'POST']) !!}
                                    @csrf
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    @if ($item->estado=='A')
                                    {!! Form::submit('Desactivar', ['class' => 'btn btn-danger btn-sm'])!!}
                                    @else
                                    {!! Form::submit('Activar', ['class' => 'btn btn-success btn-sm'])!!}
                                    @endif
                                    {!! Form::close() !!}
                                    @endcan -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    var table = $('#proyectosTable').DataTable({
		"columns": [
			null,
			null,
			null,
			null,
			{ "width": "10%" }
  		],
        "sScrollX": "100%",
        "sScrollXInner": "100%",
    });
</script>
@endsection