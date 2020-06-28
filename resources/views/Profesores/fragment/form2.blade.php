
	<div class="form-group">
		{!! Form::label('categoria','Categoria') !!}
		<select name="categoria" class="form-control">
			@foreach ($categorias as $item)
				@if ($item == $profesor->categoria)
					<option selected="selected" value="{{ $item }}">{{ $item}}</option>
					@else
						<option value="{{ $item}}">{{ $item }}</option>
				@endif
			@endforeach

		</select>
	</div>

	<div class="form-group">
		<label>
	    	{!! Form::radio('estado', 'A',$profesor->estado=="A"?true:false) !!}
			    Activo
		</label>
		<label>
			{!! Form::radio('estado', 'I',$profesor->estado=="I"?true:false) !!}
		   		 Inactvio
		</label>
	</div>
	<div class="form-group">
		{!! Form::label('area_academica','Area academica') !!}
		<select name="area_academica_id" class="form-control">
			@foreach ($areas_academicas as $item)
				@if ($item->id == $profesor->area_academica_id)
					<option selected="selected" value="{{ $item->id }}">{{ $item->nombreArea }}</option>
					@else
						<option value="{{ $item->id }}">{{ $item->nombreArea }}</option>
				@endif
			@endforeach
		</select>
	</div>
	
	<div class="form-group">
		{!! Form::label('fingreso','Fecha de ingreso') !!}
		{!! Form::date('fingreso', null, ['class' => 'form-control']) !!}
	</div>
		<div class="form-group">
		{!! Form::label('fsalida','Fecha de salida') !!}
		{!! Form::date('fsalida', null, ['class' => 'form-control']) !!}
	</div>
<div class="modal-footer">
		@can('profesores.edit')<button type="submit" class="btn btn-success">Enviar</button>@endcan
		<a class="btn btn-info" href="{{ route('profesores.index') }}">Volver</a>
</div> 