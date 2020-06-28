@extends('layouts.app')
@section('content') 
@include('ciclo.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content">
				{!! Form::open(['route'=>'areaacademica.store']) !!}	
					<div class="modal-body">
						<div class="text-center">
							<h5 >Nueva Area</h5>
						</div>
							<div class="form-group">
								{!! Form::label('nombreArea','Nombre area') !!}
								{!! Form::text('nombreArea',old('nombre'),['class'=>'form-control','placeholder'=> 'nombre de la area']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('descripcion','Descripcion') !!}
								{!! Form::text('descripcion',old('nombre'),['class'=>'form-control','placeholder'=> 'Descripcion del area']) !!}
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
							<button type="submit" class="btn btn-success">Enviar</button>
							<a class="btn btn-info" href="{{ route('areaacademica.index') }}">Volver</a>
					</div> 
					{!! Form::close() !!}		
			</div>	
		</div>
		</div>
	  </div>
	
@endsection

