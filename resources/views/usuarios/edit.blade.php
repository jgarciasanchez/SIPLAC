@extends('layouts.app')

@section('content')
@include('usuarios.fragment.error')				
	<div class="col-md-12">
		<div class="col-md-12">
				<div class="col-md-12 text-center">
					<h5>Editar datos</h5>
				</div>
			<div class="row">
			<div class="col-md-6">	
				{!! Form::model($user,['route'=>['usuarios.update',$user->id],'method'=>'PUT']) !!}
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
						    	{!! Form::radio('estado', 'A',$user->estado=="A"?true:false) !!}
								    Activo
							</label>
							<label>
								{!! Form::radio('estado', 'I',$user->estado=="A"?true:false) !!}
							   		 Inactvio
							</label>
						</div>
						<div class="form-group">
							{!! Form::label('password_confirmation','Password confirmation') !!}
							{!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=> 'Password confirmation']) !!}
						</div>
			</div>
			<div class="col-md-6">
					<ul class="list-group">
						@foreach($roles as $role)
							<label data-toggle="tooltip" data-placement="top" title="Selecciona el rol que desea para el usuario">
							    <li class="list-group-item">
							        {{ Form::checkbox('roles[]', $role->id, null) }}
							        {{ $role->name }}
							        <div class="text-center">
							       		 <em>({{ $role->description }})</em>
							        </div>  
							    </li>
							  </label>
						    @endforeach
						   {{ $roles->links() }}
					    </ul> 
			</div>  
			<div >
					@can('usuarios.edit')
						<button type="submit" class="btn btn-success">Enviar</button>
					@endcan
			   		<a class="btn btn-info" href="{{ route('usuarios.index') }}">Volver</a>
			</div>
		</div>
		{!! Form::close() !!}
		</div>
	 </div>
@endsection

