@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="shadow-lg">
	<div class="row">
		<div class="col-md-12">
			<div class="modal-content ">
				<div class="modal-body">
					<div>
						<button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="ver" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Descargar
						</button>
						<div class="dropdown-menu" aria-labelledby="ver">
							<a class="dropdown-item" href="{{ route('infoReporte', [$ids, 2, 1]) }}">Word</a>
						</div>
					</div>

					<div class="text-center">
						@for ($i = 0; $i < count($profesores); $i++) 
						@foreach ($profesores[$i] as $prof) 
						<h5> {{ $prof->nombre1 }} {{ $prof->apellido1 }} {{ $prof->apellido2 }}</h5>
							@if($arrayCursos[$i] != null)
							<div>
								<table class="table table-sm table-bordered">
									<thead>
										<tr>
											<th class="mx-auto" scope="row">Nombre del Curso</th>
											<th class="mx-auto" scope="row">Código</th>
											<th class="mx-auto" scope="row">NRC</th>
											<th class="mx-auto" scope="row">Grupo</th>
											<th class="mx-auto" scope="row">Créditos</th>
											<th class="mx-auto" scope="row">Horas Contacto</th>
											<th class="mx-auto" scope="row">Jornada</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											@php 
												$band = true
											@endphp
											@foreach($arrayCursos[$i] as $curso)
										<tr>
											<td>{{ $curso->nombre_cur }}</td>
											<td>{{ $curso->codigo }}</td>
											<td>{{ $curso->nrc }}</td>
											<td>{{ $curso->numero }}</td>
											<td>{{ $curso->creditos }}</td>
											<td>{{ $curso->horas_contacto }}</td>
											@php
												$count = 0;
												if ($arrayCursos[$i] != null){
													$count += count($arrayCursos[$i]);
												}
												if ($arrayProyectos[$i] != null){
													$count += count($arrayProyectos[$i]);
												}
											@endphp
											@if($band)
											<td rowspan="{{$count}}">
												@if($jornadas[$i] <= 5) 
												1/4 TC (10 hrs) 
												@elseif($jornadas[$i] <=8) 
												1/2 TC (20 hrs) 
												@elseif($jornadas[$i] <=11) 
												3/4 TC (30 hrs) 
												@else 
												TC (40 hrs) 
												@endif
											</td> 
											{{$band = false}} 
											@endif 
										</tr> 
											@endforeach 
										</tr> 
									</tbody> 
								</table> 
							</div> 
							@endif 
							@if($arrayProyectos[$i] !=null) 
							<div>
								<table class="table table-sm table-bordered">
									<thead>
										<tr>
											<th class="mx-auto" scope="row">Nombre del Proyecto</th>
											<th class="mx-auto" scope="row">Código SIA</th>
											<th class="mx-auto" scope="row">Jornada</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($arrayProyectos[$i] as $item)
										<tr>
											<td>{{$item->nombre}}</td>
											<td>{{$item->codigo_sia}}</td>
											<td>{{$item->codigo_sia}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
							@endforeach
							@endfor
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection