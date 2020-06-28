

{!! Form::label('nivel','nivel') !!}
<select name="nivel" class="form-control">
<option value={{$grupos->nivel}}>{{$grupos->nivel}}</option>
    @foreach ($nivel as $item)
     <option value="{{$item}}">
        @if (request('nivel') == $item) selected @endif{{$item}}
     </option>
    @endforeach
</select> 

<div class="modal-footer">
	@can('grupos.edit')	
		<button type="submit" class="btn btn-success">Enviar</button>
	@endcan
		<a class="btn btn-info" href="{{ route('grupos.index') }}">Volver</a>
</div> 