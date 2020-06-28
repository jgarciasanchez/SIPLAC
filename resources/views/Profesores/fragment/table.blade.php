<div class="row">
	{!! Form::open(['route'=>'profesores.index','method'=>'GET','class'=>'form-inline']) !!}
	@csrf
		<div class="form-group">
			{!! Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Dato']) !!}&nbsp
		</div>
		<div class="form-group">
		<select name="category" class="form-control">
			<option value="">Seleccione tipo</option>
		    <option value="Email">Email</option>
		    <option value="Telefono">Telefono</option>
		    <option value="Otros">Otros</option>
		</select>
		</div>&nbsp
		<div class="form-group">
			<button type="submit" class="btn  btn-info">
				Agregar
			</button>
		</div>
	{!! Form::close() !!}
</div>
<div class="row">
	<div class="col-sm-12">
		<ul class="list-group list-group-flush">
			
			{{-- @foreach ($array as $element) --}}
				{{-- expr --}}
			{{-- @endforeach --}}
			<li class="list-group-item" >
					<div class="row">
						88832483248
						<a href="#" class="btn btn-link btn-sm">editar</a>
						{!! Form::open(['route'=>['profesores.destroy','1'],'method'=>'POST']) !!}
							@csrf
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit('Borrar', ['class' => 'btn btn-link btn-sm'])!!}
						{!! Form::close() !!}
					</div>
			</li>
				<li class="list-group-item" >
					<div class="row">
						usuario@ejemplo.com
						<a href="#" class="btn btn-link btn-sm">editar</a>
						{!! Form::open(['route'=>['profesores.destroy','1'],'method'=>'POST']) !!}
							@csrf
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit('Borrar', ['class' => 'btn btn-link btn-sm'])!!}
						{!! Form::close() !!}
					</div>
			</li>
				<li class="list-group-item" >
					<div class="row">
						88832483248
						<a href="#" class="btn btn-link btn-sm">editar</a>
						{!! Form::open(['route'=>['profesores.destroy','1'],'method'=>'POST']) !!}
							@csrf
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit('Borrar', ['class' => 'btn btn-link btn-sm'])!!}
						{!! Form::close() !!}
					</div>
			</li>
		</ul>	
	</div>
</div>
