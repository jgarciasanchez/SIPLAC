	<div class="form-group">

		{!! Form::text('nombre',old('nombre'),['class'=>'form-control','placeholder'=> 'Nombre del Aula']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('estado','Estado (Activo/inactivo)') !!}
		{!!  Form::checkbox('estado' , null ,false)  !!}

	</div>

<div class="modal-footer">
		<button type="submit" class="btn btn-success">Enviar</button>
		<a class="btn btn-info" href="{{ route('aulas.index') }}">Volver</a>
</div>
