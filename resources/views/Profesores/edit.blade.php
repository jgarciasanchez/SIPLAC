@extends('layouts.app')
@section('content') 
@include('Profesores.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">
						<div class="text-center">
							<h5 >Editar profesor</h5>
						</div>
						{!! Form::model($profesor,['route'=>['profesores.update',$profesor->id],'method'=>'PUT']) !!}
						<div class="row">
							<div class="col-sm-6">	
							   		@include('Profesores.fragment.form')
							 </div>
							  <div class="col-sm-6">	
							   		@include('Profesores.fragment.form2')
							</div>
						</div>
						 {!! Form::close() !!}	
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection

