@extends('layouts.app')
@section('content') 
@include('Profesores.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">
						<div class="text-center">
							<h5 >Nuevo profesor</h5>
						</div>
						{!! Form::open(['route'=>'profesores.store']) !!}	
						<div class="row">
							<div class="col-sm-6">	
							   		@include('Profesores.fragment.form')
							 </div>
							  <div class="col-sm-6">	
							   		@include('Profesores.fragment.form2Create')
							</div>
						 {!! Form::close() !!}	
						</div>
						
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection

