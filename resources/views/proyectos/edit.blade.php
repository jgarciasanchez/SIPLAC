@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

<div class="shadow-lg">
    <div>
        <p></p>
    </div>
    <div class="modal-content ">
        <div class="modal-header text-center">
            <h5>Editar proyecto</h5>
        </div>

        <div class="modal-body">
            {!! Form::model($proyecto,['route'=>['proyectos.update',$proyecto->id],'method'=>'PUT']) !!}
            <div class="row justify-content-md-center">
                <div class="col-md">
                    <div class="form-group">
                        {!! Form::text('nombre',$proyecto->nombre,['class'=>'form-control','placeholder'=> 'Nombre del proyecto']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('codigo_sia',$proyecto->codigo_sia,['class'=>'form-control','placeholder'=> 'Codigo SIA']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('descripcion',$proyecto->descripcion,['class'=>'form-control','placeholder'=> 'Descripcion']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_inicio','Fecha de inicio') !!}
                        {!! Form::date('fecha_inicio', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_final','Fecha final') !!}
                        {!! Form::date('fecha_final', null, ['class' => 'form-control']) !!}

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="col-md">
                    <div>
                        <table id="proyectosTable">
                            <thead>
                                <tr>
                                    <th scope="row">Nombre</th>
                                    <th scope="row">Primer apellido</th>
                                    <th scope="row">Segundo apellido</th>
                                    <th scope="row">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profesores as $prof)
                                <tr>
                                    <td>{{ $prof->nombre1 }}</td>
                                    <td>{{ $prof->apellido1}}</td>
                                    <td>{{ $prof->apellido2 }}</td>
                                    <td class="form-inline">
                                        @if ($prof->proy_id == $proyecto->id)
                                            <a class="btn btn-primary btn-sm" href="{{ route('estadoProfesor', [$proyecto->id, $prof->id]) }}">Eliminar</a>
                                        @else
                                            <a class="btn btn-secondary btn-sm" href="{{ route('estadoProfesor', [$proyecto->id, $prof->id]) }}">Agregar</a>
                                        @endif
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
			{ "width": "15%" }
  		],
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>
@endsection