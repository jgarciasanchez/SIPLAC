
		<div class="text-center">
			<h5>Asignar Nuevo NRC</h5>
		</div>

		<div class="form-group">
			{!! Form::label('nrc','NRC') !!}
			{!! Form::text('nrc',old('nrc'),['class'=>'form-control','placeholder'=> 'NRC']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Ciclo','Ciclo') !!}
			<select name="ciclo_id" class="form-control">
				@foreach ($ciclos as $item)
				<option value={{$item->id}}>{{$item->ciclo.'('.$item->fecha_inicio.')'}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{!! Form::label('Grupo','Grupo') !!}
			<select name="grupo_id" class="form-control">
				@foreach ($grupos as $item)
				<option value={{$item->id}}>{{$item->numero}}</option>
				@endforeach
			</select>
		</div>

		
		<div class="form-group">
			{!! Form::label('Curso','Curso') !!}
			<select name="curso_id" class="form-control">
				@foreach ($cursos as $item)
				<option value={{$item->id}}>{{$item->nombre_cur}}</option>
				@endforeach
			</select>
		</div>