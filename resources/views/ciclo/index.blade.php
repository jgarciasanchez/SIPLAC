@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			@can('ciclo.create')<a class="btn btn-primary" href="{{ route('ciclo.create') }}">Nuevo Ciclo</a>@endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="ciclosTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">ciclo</th>
								<th scope="row">fecha inicio</th>
								<th scope="row">fecha fin</th>
								<th width="263" scope="row">Acciones</th>
							</tr>

						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->ciclo}}</td>
								<td>{{ $item->fecha_inicio }}</td>
								<td>{{ $item->fecha_fin }}</td>
								<td class="form-inline">
									@can('ciclo.edit')
									<a class="btn btn-primary btn-sm" href="{{ route('ciclo.edit',$item->id) }}">Editar datos</a>
									@endcan
									&nbsp
									@can('ciclo.destroy')
									{!! Form::open(['route'=>['ciclo.destroy',$item->id],'method'=>'POST']) !!}
									@csrf
									{!! Form::hidden('_method', 'DELETE') !!}
									@if ($item->estado=='I')
									{!! Form::submit('No Activo', ['class' => 'btn btn-danger btn-sm'])!!}
									@else
									{!! Form::submit('Activo', ['class' => 'btn btn-success btn-sm'])!!}
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
	var table = $('#ciclosTable').DataTable({
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection