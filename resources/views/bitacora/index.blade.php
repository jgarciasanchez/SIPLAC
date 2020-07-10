@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="ml-auto form-inline">
		</div>
	</div>
	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="bitacoraTable" class="table table-hover table-striped">
						<thead class="thead-dark">
							<th scope="row">Usuario</th>
							<th scope="row">Tabla</th>
							<th scope="row">Id</th>
							<th scope="row">Accion</th>
							<th scope="row">Columna</th>
							<th scope="row">Valor Anterior</th>
							<th scope="row">Nuevo Valor</th>
							<th scope="row">Fecha y Hora</th>
						</thead>
						<tbody>

							@foreach ($bit as $item)
							<tr>
								<td>{{ $item->usu_nombre }}</td>
								<td>{{ $item->tabla }}</td>
								<td>{{ $item->id }}</td>
								<td>{{ $item->accion }}</td>
								<td>{{ $item->columna}}</td>
								<td>{{ $item->old}}</td>
								<td>{{ $item->new}}</td>
								<td>{{ $item->created_at}}</td>
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
	var table = $('#bitacoraTable').DataTable({
		"columns": [
			null,
			null,
			null,
			null,
			null,
			{
				"width": "20%"
			},
			{
				"width": "20%"
			},
			null,
		],
		// select: true,
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection