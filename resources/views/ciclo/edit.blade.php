@extends('layouts.app')
@section('content') 
@include('ciclo.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
		  <div class="col-md-12">
			<div class="modal-content ">
				{!! Form::model($ciclo,['route'=>['ciclo.update',$ciclo->id],'method'=>'PUT']) !!}	
					<div class="modal-body">
						<div class="text-center">
							<h5 >Editar ciclo</h5>
						</div>
							<div class="form-group">
								{!! Form::label('ciclo','Ciclo') !!}
								<select name="ciclo" class="form-control">
									<option  selected="selected" value="{{$ciclo->ciclo}}">{{$act}}</option>
									<option  value="1">Ciclo 1</option>	
									<option  value="2">Ciclo 2</option>	
									<option  value="3">Verano 3</option>	
								</select>
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
						    	{!! Form::radio('estado', 'A',$ciclo->estado=="A"?true:false) !!}
								    Activo
							</label>
							<label>
								{!! Form::radio('estado', 'I',$ciclo->estado=="I"?true:false) !!}
							   		 Inactvio
							</label>
					</div>
					<div class="modal-footer">
							@can('ciclo.edit')
								<button type="submit" class="btn btn-success">Guardar</button>
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

