@extends('layouts.app')

@section('content')

<div class="col-md-12">

	<div class="row pt-5">

		<div class="">
			@can('asignacioncursos.create')<a class="btn btn-primary" href="{{ route('asignacioncursos.create') }}">Asignar Nuevo Curso</a>@endcan
		</div>

		<div class="ml-auto">

		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@include('usuarios.fragment.info')
			<table id="tabla" class="table table-hover table-striped" data-maintain-meta-data="true">
				<thead class="thead-dark">
					<th scope="row">NRC</th>
					<th scope="row">Curso</th>
					<th scope="row">Grupo</th>
					<th scope="row">Ciclo</th>
					<th scope="row">Profesor</th>
					<th scope="row">Acciones</th>
				</thead>
				<tbody>
					@foreach ($list as $item)
					<tr>
						<td>{{ $item->nrc }}</td>
						<td>{{ $item->nombreCurso}}</td>
						<td>{{ $item->nombreGrupo}}</td>
						<td>{{ $item->nombreCiclo }}</td>
						<td>{{ $item->nombreProfe }}</td>
						<td class="form-inline">
							<a class="btn btn-primary btn-sm" href="{{ route('asignacioncursos.edit',$item->id) }}">Editar datos</a>&nbsp
							{!! Form::open(['route'=>['asignacioncursos.destroy',$item->id],'method'=>'POST']) !!}
							@csrf
							{!! Form::hidden('_method', 'DELETE') !!}
							@if ($item->estado=='A')
							{!! Form::submit('Eliminar', ['class' => 'btn btn-success btn-sm'])!!}
							@else
							{!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm'])!!}
							@endif
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>

	</div>

</div>

<script type="text/javascript">
	var table = $('#tabla').DataTable({
		"columns": [
			null,
			null,
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