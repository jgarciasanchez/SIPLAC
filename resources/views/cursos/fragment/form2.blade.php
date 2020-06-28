<div class="form-group">
    {!! Form::label('estado','Estado (Activo/inactivo)') !!}
    {!! Form::checkbox('estado' , null , $cursos->estado=="A"?true:false) !!}
</div>

<div class="form-group">
    {!! Form::label('are_id','Area Academica') !!}
    <select name="are_id" class="form-control">
        @foreach ($list as $item)
        <option value={{$item->id}}>{{$item->nombreArea}}</option>
        @endforeach
    </select>

</div>
<div class="modal-footer">
   @can('editRelations')
    <a class="btn btn-info" href="{{ route('editRelations',$cursos->id) }}">Editar avanzado</a>
    @endcan
   @can('cursos.edit')  
    <button type="submit" class="btn btn-success">Guardar</button>
   @endcan
    <a class="btn btn-info" href="{{ route('cursos.index') }}">Volver</a>
</div>