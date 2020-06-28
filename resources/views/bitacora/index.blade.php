@extends('layouts.app')

  @section('content')

			<div class="col-md-12">

				<div class="row">
					<div class="col-md-12">
					@include('usuarios.fragment.info')
					<table class="table table-hover table-striped">
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
					{{ $bit->render() }}
				</div>

				</div>

			</div>

@endsection
