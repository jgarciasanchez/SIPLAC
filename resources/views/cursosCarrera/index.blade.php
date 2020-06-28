@extends('layouts.app')
@section('content') 

	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				{!! Form::open(['route'=>'cursosCarrera.store']) !!}	
					<div class="modal-body">
						<div class="text-center">
							<h5 >Asignacion de cursos y carreras</h5>
						</div>
							
						<div class="row">
							{!! Form::label('curso_id','Cursos') !!}
                        	<select name="curso_id" class="form-control">
                       		 	@foreach ($cursosL as $item)
	                            	<option value={{$item->id}}>{{$item->nombre_cur}}</option>
                        		@endforeach
                        	</select> 
	                        
						</div>

						<div class="row">
							{!! Form::label('carrera_id','Careras') !!}
                        	<select name="carrera_id" class="form-control">
                       		 	@foreach ($carreras as $item)
	                            	<option value={{$item->id}}>{{$item->nombre}}</option>
                        		@endforeach
                        	</select> 
	                        
						</div>

						
					</div>
					<div class="modal-footer">
						@can('cursosCarrera.create')
							<button type="submit" class="btn btn-success">Asignar</button>
						@endcan
				 	</div> 
				{!! Form::close() !!}		
			</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection