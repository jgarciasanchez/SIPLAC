@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="ml-auto form-inline">
			@can('excel.excel')
			<a class="nav-link " href="{{ route('excel')}}">
				Lista completa(Excel)
			</a>
			<button class="mx-2" id="button1">Reporte Simple</button>

			<button class="mx-2" id="button2">Reporte medio</button>

			<button class="mx-2" id="button3">Reporte completo</button>

			<button class="mx-2" id="button4">Formulario Programas</button>

			@endcan
		</div>
	</div>
	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					<table id="profesoresDataReportes" class="table table-hover table-striped" data-maintain-meta-data="true">
						<thead class="thead-dark">
							<tr>
								<th scope="row"></th>
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
								<td>
									<input type="checkbox" id="{{ $item->id }}">
								</td>
								<td>{{ $item->nombre1}}</td>
								<td>{{ $item->apellido1 }}</td>
								<td>{{ $item->apellido2 }}</td>
								<td>{{ $item->cedula }}</td>
								<td>
									<div>
										<button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="ver" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Ver reporte
										</button>
										<div class="dropdown-menu" aria-labelledby="ver">
											@can('infoReporte.infoReporte')
												<a class="dropdown-item" href="{{ route('infoReporte', [$item->cedula, 1, 1]) }}">Simple</a>
												<a class="dropdown-item" href="{{ route('infoReporte', [$item->cedula, 1, 2]) }}">Medio</a>
												<a class="dropdown-item" href="{{ route('infoReporte', [$item->cedula, 1, 3]) }}">Completo</a>
											@endcan
										</div>
									</div>
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
	var table = $('#profesoresDataReportes').DataTable({
		"columns": [
			null,
			null,
			null,
			null,
			null,
			{
				"width": "10%"
			}
		],
		// select: true,
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});

	var table = $('#profesoresDataReportes').DataTable();
 
    $('#profesoresDataReportes tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );



	$('#button1').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[4]
		});
		if (ids[0] != null) {
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 1;
		}
	});
	$('#button2').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[4]
		});
		if (ids[0] != null) {
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 2;
		}
	});
	$('#button3').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[4]
		});
		if (ids[0] != null) {
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 3;
		}
	});
	$('#button4').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[4]
		});
		if (ids[0] != null) {
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 4;
		}

	});
</script>


@endsection