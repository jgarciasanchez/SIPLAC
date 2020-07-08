@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			 @can('carrera.create')<a class="btn btn-primary" href="{{ route('carrera.create') }}">Nueva Carrera</a> @endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="carreraTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Nombre</th>
								<th scope="row">Area</th>
								<th width="263" scope="row">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->nombre }}</td>
								<td>{{ $item->nombreArea }}</td>
								<td class="form-inline">
									<a class="btn btn-primary btn-sm" href="{{ route('carrera.edit',$item->id) }}">Editar datos</a>&nbsp
									{!! Form::open(['route'=>['carrera.destroy',$item->id],'method'=>'POST']) !!}
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
	var table = $('#carreraTable').DataTable({
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection