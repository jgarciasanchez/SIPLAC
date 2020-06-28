@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			<a class="btn btn-primary" href="{{ route('areaacademica.create') }}">Nueva Area</a>
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="areasTabla" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Nombre</th>
								<th scope="row">Descripcion</th>
								<th scope="row">estado</th>
								<th scope="row">Acciones</th>
							</tr>

						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->nombreArea}}</td>
								<td>{{ $item->descripcion }}</td>
								<td>{{ $item->estado }}</td>
								<td class="form-inline">
									<a class="btn btn-primary btn-sm" href="{{ route('areaacademica.edit',$item->id) }}">Editar datos</a>&nbsp
									{!! Form::open(['route'=>['areaacademica.destroy',$item->id],'method'=>'POST']) !!}
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
	var table = $('#areasTabla').DataTable({
		"columns": [
			null,
			null,
			null,
			{
				"width": "13%"
			}
		],
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection