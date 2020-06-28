
	

	{!! Form::label('niveles','niveles') !!}
	<select name="niveles" class="form-control">
	    @foreach ($niveles as $item)
	     <option value="{{$item}}">
            @if (request('niveles') == $item) selected @endif{{$item}}
         </option>
	    @endforeach
	</select> 


	
<div class="modal-footer">
		@can('grupos.create')<button type="submit" class="btn btn-success">Enviar</button>@endcan
		<a class="btn btn-info" href="{{ route('grupos.index') }}">Volver</a>
</div> 