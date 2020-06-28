<div class="text-center">
	<h5>Profesores</h5>
</div>

<div class="form-group">
	{!! Form::label('ProfesorPermanente','Profesor Permanente') !!}
	<select name="profesorPermanente_id" id="profesorPermanente_id" class="form-control">
		<option value="Ninguno" >Sin Asignar</option> 
		@foreach ($profesores as $item)
		<option value={{$item->id}}>{{$item->nombre1.' '.$item->apellido1.' '.$item->apellido2}}</option>
		@endforeach
	</select>
</div>
&nbsp


<div class="form-group">
	{!! Form::label('ProfesorSuplente','Profesor Suplente') !!}
	<select name="profesorSuplente_id" id="profesorSuplente_id" class="form-control">
		<option value="Ninguno" >Sin Asignar</option>    
		@foreach ($profesores as $item)
		<option value={{$item->id}}>{{$item->nombre1.' '.$item->apellido1.' '.$item->apellido2}}</option>
		@endforeach
	</select>
</div>
&nbsp
&nbsp&nbsp
<div class="modal-footer">
	<button type="submit" class="btn btn-success">Enviar</button>
	<a class="btn btn-info" href="{{ route('asignacioncursos.index') }}">Volver</a>
</div> 