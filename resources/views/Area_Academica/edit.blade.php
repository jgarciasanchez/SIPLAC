@extends('layouts.app')
@section('content') 
@include('ciclo.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
		  <div class="col-md-12">
			<div class="modal-content ">
				{!! Form::model($AreasAcademicas,['route'=>['areaacademica.update',$AreasAcademicas->id],'method'=>'PUT']) !!}	
					<div class="modal-body">
						<div class="text-center">
							<h5 >Editar Area</h5>
						</div>
						<div class="form-group">
								{!! Form::label('nombreArea','Nombre') !!}
								{!! Form::text('nombreArea',old('nombre'),['class'=>'form-control','placeholder'=> 'Nombre Area']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('descripcion','Descripcion') !!}
								{!! Form::text('descripcion',old('nombre'),['class'=>'form-control','placeholder'=> 'Descripcion Area']) !!}
							</div>
						   	<label>
						    	{!! Form::radio('estado', 'A',$AreasAcademicas->estado=="A"?true:false) !!}
								    Activo
							</label>
							<label>
								{!! Form::radio('estado', 'I',$AreasAcademicas->estado=="I"?true:false) !!}
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

