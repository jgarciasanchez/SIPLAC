
	<div class="form-group">
		{!! Form::label('categoria','Categoria') !!}
		<select name="categoria" class="form-control">
			@foreach ($categorias as $item)
					<option value="{{$item}}">{{ $item }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
	    	{!! Form::radio('estado', 'A',true) !!}
			    Activo
		</label>
		<label>
			{!! Form::radio('estado', 'I') !!}
		   		 Inactvio
		</label>
 
	</div>
	<div class="form-group">
		{!! Form::label('area_academica','Area academica') !!}
		<select name="area_academica_id" class="form-control">
			@foreach ($areas_academicas as $item)
				<option value="{{ $item->id }}">{{ $item->nombreArea }}</option>
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
		@can('profesores.create')}<button type="submit" class="btn btn-success">Enviar</button>@endcan
		<a class="btn btn-info" href="{{ route('profesores.index') }}">Volver</a>
</div> 