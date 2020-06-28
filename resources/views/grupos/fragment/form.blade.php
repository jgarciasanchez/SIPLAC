	
	<div class="form-group">
		{!! Form::label('Numero grupo','Numero grupo') !!}
		{!! Form::text('numero',old('numero'),['class'=>'form-control','placeholder'=> 'numero grupo']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('estado','Estado (Activo/inactivo)') !!}
		{!!  Form::checkbox('estado' , null ,false)  !!}

	</div>
