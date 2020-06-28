@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline">
			@can('usuarios.create')
			<a data-toggle="tooltip" data-placement="top" title="Crea un nuevo usuario" class="btn btn-primary" href="{{ route('usuarios.create') }}">Nuevo</a>
			@endcan
			@can('roles.edit')
			<a data-toggle="tooltip" data-placement="top" title="Edita los roles existentes o crea uno nuevo" class="btn btn-info" href="{{ route('roles.index') }}">Editar roles</a>
			@endcan
		</div>
	</div>
	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="usuariosTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Nombre</th>
								<th scope="row">Usuario</th>
								<th scope="row">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->nombre }}</td>
								<td>{{ $item->usuario }}</td>
								<td class="form-inline">
									@can('usuarios.edit')
									<a data-toggle="tooltip" data-placement="top" title="Edita los datos de los usuarios asi como sus roles" class="btn btn-primary" href="{{ route('usuarios.edit',$item->id) }}">Editar
									</a>&nbsp
									@endcan
									@can('usuarios.destroy')
									{!! Form::open(['route'=>['usuarios.destroy',$item->id],'method'=>'POST']) !!}
									@csrf
									{!! Form::hidden('_method', 'DELETE') !!}
									@if ($item->estado=='A')
									<button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Desactiva el usuario">
										Desactivar
									</button>
									@else
									<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Activa el usuario">
										Activar
									</button>
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
	var table = $('#usuariosTable').DataTable({
		"columns": [
			null,
			null,
			{ "width": "15%" }
  		],
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection