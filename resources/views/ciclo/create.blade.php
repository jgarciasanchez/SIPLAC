@extends('layouts.app')
@section('content') 
@include('ciclo.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content">
				{!! Form::open(['route'=>'ciclo.store']) !!}	
					<div class="modal-body">
						<div class="text-center">
							<h5 >Nuevo ciclo</h5>
						</div>
							<div class="form-group">
								{!! Form::label('ciclo','ciclo') !!}
								{!! Form::text('ciclo',old('ciclo'),['class'=>'form-control','placeholder'=> 'Ciclo(1,2,3)']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('fecha_inicio','Fecha de inicio') !!}
								{!! Form::date('fecha_inicio', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('fecha_fin','Fecha de fin') !!}
								{!! Form::date('fecha_fin', null, ['class' => 'form-control']) !!}
							</div>
						   	<label>
						    	{!! Form::radio('estado', 'A',true) !!}
								    Activo
							</label>
							<label>
								{!! Form::radio('estado', 'I',false) !!}
							   		 Inactvio
							</label>
					</div>	
					<div class="modal-footer">
							@can('ciclo.create')
								<button type="submit" class="btn btn-success">Enviar</button>
							@endcan
							@can('ciclo.index')
								<a class="btn btn-info" href="{{ route('ciclo.index') }}">Volver</a>
							@endcan
					</div> 
					{!! Form::close() !!}		
			</div>	
		</div>
		</div>
	  </div>
	
@endsection

