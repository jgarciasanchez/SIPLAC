

@extends('layouts.app')
@section('content') 
@include('asignacioncursos.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">
						{!! Form::model($grupoCurso,['route'=>['asignacioncursos.update',$grupoCurso->id],'method'=>'PUT']) !!}
						<div class="row">
							<div class="col-sm-6">	
							   		<div class="text-center">
										<h5>Edicion NRC</h5>
									</div>

									<div class="form-group">
										{!! Form::label('nrc','NRC') !!}
										{!! Form::text('nrc',old('nrc'),['class'=>'form-control','placeholder'=> 'NRC']) !!}
									</div>

									<div class="form-group">
										{!! Form::label('Ciclo','Ciclo') !!}
										<select name="ciclo_id" class="form-control">
											@foreach ($ciclos as $item)
											<option value={{$item->id}}>{{$item->id}}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										{!! Form::label('Grupo','Grupo') !!}
										<select name="grupo_id" class="form-control">
											@foreach ($grupos as $item)
											<option value={{$item->id}}>{{$item->numero}}</option>
											@endforeach
										</select>
									</div>

									
									<div class="form-group">
										{!! Form::label('Curso','Curso') !!}
										<select name="curso_id" class="form-control">
											@foreach ($cursos as $item)
											<option value={{$item->id}}>{{$item->nombre_cur}}</option>
											@endforeach
										</select>
									</div>
							 </div>
							  <div class="col-sm-6">	
							   		<div class="text-center">
										<h5>Profesores</h5>
									</div>

									<div class="form-group">
										{!! Form::label('ProfesorPermanente','Profesor Permanente') !!}
										<select name="profesorPermanente_id" id="profesorPermanente_id" class="form-control">
											@if ($profe!=null)
											<option value={{$profe->id}}>{{$profe->nombre1.' '.$profe->apellido1.' '.$profe->apellido2}}</option>
											@endif
											<option value="Ninguno" >Sin Asignar</option>
											@foreach ($profesores as $item)
											<option value={{$item->id}}>{{$item->nombre1.' '.$item->apellido1.' '.$item->apellido2}}</option>
											@endforeach
										</select>
									</div>
									&nbsp


									<div class="form-group">
										{!! Form::label('ProfesorSuplente','Profesor Suplente') !!}
										
										<select name="profesorSuplente_id" id="profesorSuplente_id" class="form-control">
											
											@if ($profeT != null)
											<option value={{$profeT->id}}>{{$profeT->nombre1.' '.$profeT->apellido1.' '.$profeT->apellido2}}</option>
											@endif
											<option value="Ninguno" >Sin Asignar</option>
											@foreach ($profesores as $item)
											<option value={{$item->id}}>{{$item->nombre1.' '.$item->apellido1.' '.$item->apellido2}}</option>
											@endforeach
											
										</select>
									</div>
									&nbsp
									&nbsp&nbsp
									<div class="modal-footer">
										@can('asignacioncursos.edit')<button type="submit" class="btn btn-success">Enviar</button>@endcan
										<a class="btn btn-info" href="{{ route('asignacioncursos.index') }}">Volver</a>
									</div> 
							</div>
						 {!! Form::close() !!}	
						</div>
						
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection