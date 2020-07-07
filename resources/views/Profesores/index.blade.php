@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			 @can('profesores.create')<a class="btn btn-primary" href="{{ route('profesores.create') }}">Nuevo profesor</a> @endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="profesoresTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Estado</th>
								<th scope="row">Nombre</th>
								<th scope="row">Primer Apellido</th>
								<th scope="row">Segundo Apellido</th>
								<th scope="row">Cédula</th>
								<th scope="row">Acciones</th>
							</tr>

						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->estado }}</td>
								<td>{{ $item->nombre1}}</td>
								<td>{{ $item->apellido1 }}</td>
								<td>{{ $item->apellido2 }}</td>
								<td>{{ $item->cedula }}</td>
								<td class="form-inline">
									@can('profesores.edit')
									<a class="btn btn-primary btn-sm" href="{{ route('profesores.edit',$item->id) }}">Editar datos</a>
									@endcan
									&nbsp
									@can('profesores.destroy')
									{!! Form::open(['route'=>['profesores.destroy',$item->id],'method'=>'POST']) !!}
									@csrf
									{!! Form::hidden('_method', 'DELETE') !!}
									@if ($item->estado=='A')
									{!! Form::submit('Desactivar', ['class' => 'btn btn-danger btn-sm'])!!}
									@else
									{!! Form::submit('Activar', ['class' => 'btn btn-success btn-sm'])!!}
									@endif
									{!! Form::close() !!}
									@endcan
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
	var table = $('#profesoresTable').DataTable({
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