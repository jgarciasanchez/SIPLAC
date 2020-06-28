	
	<div class="form-group">
	
		{!! Form::text('nombre1',old('nombre1'),['class'=>'form-control','placeholder'=> 'Primer nombre']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('nombre2',old('nombre2'),['class'=>'form-control','placeholder'=> 'Segundo nombre']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('apellido1',old('apellido1'),['class'=>'form-control','placeholder'=> 'Primer pellido']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('apellido2',old('apellido2'),['class'=>'form-control','placeholder'=> 'Segundo pellido']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('cedula',old('cedula'),['class'=>'form-control','placeholder'=> 'Cédula']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('fnacimiento','Fecha de nacimiento') !!}
		{!! Form::date('fnacimiento', null, ['class' => 'form-control']) !!}
	</div>
		<div class="form-group">
		
		{!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=> 'Email']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('telefono',old('telefono'),['class'=>'form-control','placeholder'=> 'Numero de telefono']) !!}
	</div>

