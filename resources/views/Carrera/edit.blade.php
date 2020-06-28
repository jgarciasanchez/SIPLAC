@extends('layouts.app')
@section('content')  
@include('Carrera.fragment.error')					
	<div class="modal-dialog shadow-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Editar Carrera</h5>
				</div>
			<div class="modal-body">	
                {!! Form::model($carrera,['route'=>['carrera.update',$carrera->id],'method'=>'PUT']) !!}
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
                        {!! Form::date('fecha_apertura', old('fecha_apertura'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_cierre','Fecha de cierre') !!}
                        {!! Form::date('fecha_cierre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
						{!! Form::label('niv_id','Grado carrera') !!}
						<select name="grado" class="form-control">
							<option value={{$nivAct}}>{{$nivAct}}</option>
						    @foreach ($nivel as $item)
						    <option value={{$item}}>{{$item}}</option>
						    @endforeach
						</select>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
				   		<a class="btn btn-info" href="{{ route('carrera.index') }}">Volver</a>
				 	</div> 
			   	{!! Form::close() !!}
			</div>
		</div>
	 </div>
@endsection
