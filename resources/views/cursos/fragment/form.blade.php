	
	<div class="form-group">
	
		{!! Form::text('nombre_cur',old('nombre_cur'),['class'=>'form-control','placeholder'=> 'Nombre Curso']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('codigo',old('codigo'),['class'=>'form-control','placeholder'=> 'Codigo Curso']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('creditos',old('creditos'),['class'=>'form-control','placeholder'=> 'Creditos del curso']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('horas',old('horas'),['class'=>'form-control','placeholder'=> 'Horas']) !!}
	</div>
	<div class="form-group">
		
		{!! Form::text('horas_contacto',old('horas_contacto'),['class'=>'form-control','placeholder'=> 'horas_contacto']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('carrera_id','Carrera') !!}
		<select name="carrera_id" class="form-control">
		    @foreach ($carreras as $item)
		    <option value={{$item->id}}>{{$item->nombre}}</option>
		    @endforeach
		</select>
	</div>
