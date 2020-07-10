@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			@can('grupos.create')<a class="btn btn-primary" href="{{ route('grupos.create') }}">Nuevo Grupo</a>@endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('usuarios.fragment.info')
					<table id="gruposTable" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row">Numero</th>
								<th scope="row">Nivel</th>
								<th width="263" scope="row">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($list as $item)
							<tr>
								<td>{{ $item->numero }}</td>
								<td>{{ $item->nivel}}</td>

								<td class="form-inline">
									@can('grupos.edit')
									<a class="btn btn-primary btn-sm" href="{{ route('grupos.edit',$item->id) }}">Editar datos</a>
									@endcan&nbsp
									@can('grupos.destroy')
									{!! Form::open(['route'=>['grupos.destroy',$item->id],'method'=>'POST']) !!}
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
	var table = $('#gruposTable').DataTable({
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection