@extends('layouts.app')
@section('content')  	
@include('Carrera.fragment.error')				
	<div class="modal-dialog shadow-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Crear carrera</h5>
				</div>
			<div class="modal-body">	
				{!! Form::open(['route'=>'carrera.store']) !!}
			   		<div class="form-group">
						{!! Form::label('nombre','Nombre de Carrera') !!}
						{!! Form::text('nombre',old('nombre'),['class'=>'form-control','placeholder'=> 'Nombre']) !!}
					</div>
					<div class="form-group">
                        {!! Form::label('are_id','Area Academica') !!}
                        <select name="are_id" class="form-control">
                        @foreach ($list as $item)
                            <option value={{$item->id}}>{{$item->nombreArea}}</option>
                        @endforeach
                        </select> 
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_apertura','Fecha de apertura') !!}
                        {!! Form::date('fecha_apertura', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_cierre','Fecha de cierre') !!}
                        {!! Form::date('fecha_cierre', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
						{!! Form::label('niv_id','Grado carrera') !!}
						<select name="niv_id" class="form-control">
						    @foreach ($nivel as $item)
						    <option value={{$item}}>{{$item}}</option>
						    @endforeach
						</select>
					</div>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
				   		<a class="btn btn-info" href="{{ route('carrera.index') }}">Volver</a>
				 	</div> 
			   	
			</div>
		</div>
	 </div>
@endsection
