@extends('layouts.app')
@section('content') 
@include('cursos.fragment.error')	


	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">
						<div class="text-center">
							<h5 >Nuevo cursos</h5>
						</div>
						{!! Form::open(['route'=>'cursos.store']) !!}	
						<div class="row">
							<div class="col-sm-6">	
							   		@include('cursos.fragment.form')
							 </div>
							  <div class="col-sm-6">	
							   		
			                        @include('cursos.fragment.form2Create')

							</div>
						 {!! Form::close() !!}	
						</div>

						<div class="form-group">
	                        
                        
                    	</div>
						{!! Form::close() !!}
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection

