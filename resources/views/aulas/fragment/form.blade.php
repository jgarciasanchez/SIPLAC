<div class="form-group">

	{!! Form::text('numero',old('numero'),['class'=>'form-control','placeholder'=> 'Nombre del Aula']) !!}
</div>

<div class="form-group">
	{!! Form::label('estado','Estado (Activo)') !!}
	{!!  Form::checkbox('estado' , null ,false)  !!}

</div>

<div class="form-group">
	{!! Form::text('capacidad',old('capacidad'),['class'=>'form-control','placeholder'=> 'Capacidad del Aula']) !!}
</div>

<div class="modal-footer">
	<button type="submit" class="btn btn-success">Enviar</button>
	<a class="btn btn-info" href="{{ route('aulas.index') }}">Volver</a>
</div>
