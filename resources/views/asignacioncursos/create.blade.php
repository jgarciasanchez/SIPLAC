

@extends('layouts.app')
@section('content') 
@include('asignacioncursos.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">

                        {!! Form::open(['route'=>'asignacioncursos.store','method'=>'GET']) !!}
						<div class="row">
							<div class="col-sm-6">	
							   		@include('asignacioncursos.fragment.form')
							 </div>
							  <div class="col-sm-6">	
							   		@include('asignacioncursos.fragment.form2Create')
							</div>
						 {!! Form::close() !!}	
						</div>
						
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection

