
<div class="row">
	
<div class="col-md-4">
	<div class="form-group">
		{{ Form::label('name', 'Nombre de la etiqueta') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name','data-toggle' => 'tooltip','data-placement' => 'top','title' => 'Titulo de el rol']) }}
	</div>
	<div class="form-group">
		{{ Form::label('description', 'Descripción') }}
		{{ Form::textarea('description', null, ['class' => 'form-control','data-toggle' => 'tooltip','data-placement' => 'top','title' => 'Descripcion de el rol']) }}
	</div>
	<hr>
	<h3>Permiso especial</h3>
	<div class="form-group">
	 	<!-- <label>{{ Form::radio('special', 'all-access') }} Acceso total</label>
	 	<label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label> -->
	</div>
	<div>
		
		<button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Guardar los cambios">
		  Guardar
		</button>
		<a data-toggle="tooltip" data-placement="top" title="Regresa a el la pantalla anterior" class="btn btn-primary" href="{{route('roles.index') }}" >
			Volver
		</a>
	</div>
</div>
<div class="col-md-8">
	<hr>
	<h3>Lista de permisos</h3>
	<div class="">
		<ul class="list-group">
			@foreach($permissions as $permission)
				<label data-toggle="tooltip" data-placement="top" title="Selecciona los permisos que desea para el rol">
				    <li class="list-group-item"> 
				    	  {{ Form::checkbox('permissions[]', $permission->id, null) }}
				    	  {{ $permission->second_name }}
				    	  <div class="text-center">
					    	 
						        <em >({{ $permission->description }})</em>
					       	 
				    	  </div>
				    </li> 
				</label>
		    @endforeach
	    </ul>
	</div>	
</div>
</div>


