@extends('layouts.app')
@section('content')  
@include('usuarios.fragment.error')				

	<div class="col-md-12">
			<div class="col-md-12">
				<div class="col-md-12 text-center">
					<h5>Nuevo Usuario</h5>
				</div>
			<div class="row">	
				<div class="col-md-6">
					
				{!! Form::open(['route'=>'usuarios.store']) !!}
			   		<div class="form-group">
						{!! Form::label('nombre','Nombre') !!}
						{!! Form::text('nombre',old('nombre'),['class'=>'form-control','placeholder'=> 'Nombre']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('usuario','Usuario') !!}
						{!! Form::text('usuario',old('usuario'),['class'=>'form-control','placeholder'=> 'Usuario']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password','Password') !!}
						{!! Form::password('password',['class'=>'form-control','placeholder'=> 'Password']) !!}
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
						{!! Form::label('password_confirmation','Password confirmation') !!}
						{!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=> 'Password confirmation']) !!}
					</div>

				</div>
			<div class="col-md-6">
					<ul class="list-unstyled">
						@foreach($roles as $role)
						    <li>
						        <label>
						        {{ Form::checkbox('roles[]', $role->id, null) }}
						        {{ $role->name }}
						        <em>({{ $role->description }})</em>
						        </label>
						    </li>
						    @endforeach
						   {{ $roles->links() }}
					    </ul> 
		
					<div class="text-center">
						@can('usuarios.create')
							<button type="submit" class="btn btn-success">Enviar</button>
						@endcan
				   		<a class="btn btn-info" href="{{ route('usuarios.index') }}">Volver</a>
				 	</div>
			</div>   
			   	{!! Form::close() !!}
			</div>
		</div>
	 </div>
@endsection

