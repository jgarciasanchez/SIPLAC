@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			@can('cursos.create')<a class="btn btn-primary" href="{{ route('cursos.create') }}">Nuevo Cursos</a>@endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="cursosTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Nombre</th>
								<th scope="row">Codigo</th>
								<th scope="row">Creditos</th>
								<th scope="row">Area</th>
								<th scope="row">Horas</th>
								<th scope="row">Horas conctacto</th>
								<th width="263" scope="row">Acciones</th>
							</tr>

						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->nombre_cur }}</td>
								<td>{{ $item->codigo }}</td>
								<td>{{ $item->creditos }}</td>
								<td>{{ $item->nombreArea }}</td>
								<td>{{ $item->horas }}</td>
								<td>{{ $item->horas_contacto }}</td>

								<td class="form-inline">
									@can('cursos.edit')
									<a class="btn btn-primary btn-sm mr-3" href="{{ route('cursos.edit',$item->id) }}">Editar datos</a>
									@endcan
									{!! Form::open(['route'=>['cursos.destroy',$item->id],'method'=>'POST']) !!}
									@csrf
									{!! Form::hidden('_method', 'DELETE') !!}
									@if ($item->estado=='A')
									{!! Form::submit('Desactivar', ['class' => 'btn btn-danger btn-sm'])!!}
									@else
									{!! Form::submit('Activar', ['class' => 'btn btn-success btn-sm'])!!}
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
	</div>
</div>
</div>

<script type="text/javascript">
	var table = $('#cursosTable').DataTable({
		"columns": [
			null,
			null,
			{
				"width": "6%"
			},
			null,
			{
				"width": "8%"
			},
			{
				"width": "10%"
			},
			{
				"width": "20%"
			}
		],
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection