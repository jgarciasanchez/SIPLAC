@extends('layouts.app')
@section('content') 
@include('grupos.fragment.error')	
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">
				
					<div class="modal-body">
						<div class="text-center">
							<h5 >Editar Grupos</h5>
						</div>
						{!! Form::model($grupos,['route'=>['grupos.update',$grupos->id],'method'=>'PUT']) !!}	
						<div class="row">
							<div class="col-sm-6">	
							   		
	<div class="form-group">
		{!! Form::label('Numero grupo','Numero grupo') !!}
		{!! Form::text('numero',old('numero'),['class'=>'form-control','placeholder'=> 'numero grupo']) !!}
	</div>

<div class="form-group">
        <label>
            {!! Form::radio('estado', 'A',$grupos->estado=="A"?true:false) !!}
                Activo
        </label>
        <label>
            {!! Form::radio('estado', 'I',$grupos->estado=="I"?true:false) !!}
                    Inactvio
        </label>
</div>
							 </div>
							  <div class="col-sm-6">	
							   		@include('grupos.fragment.form2')
							</div>
						 {!! Form::close() !!}	
						</div>
						
					</div>
					
			</div>
		</div>
	  </div>
	 </div>
	
@endsection

