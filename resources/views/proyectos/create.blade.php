@extends('layouts.app')
@section('content')
<div class="modal-dialog shadow-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Crear proyecto</h5>
        </div>
        <div class="modal-body">
            {!! Form::open(['route'=>'proyectos.store']) !!}
            <div class="form-group">
                {!! Form::text('nombre', '',['class'=>'form-control','placeholder'=> 'Nombre del proyecto']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('codigo_sia', '',['class'=>'form-control','placeholder'=> 'Codigo SIA']) !!}
            </div>
            <div class="form-group">
                {!! Form::textarea('descripcion','',['class'=>'form-control','placeholder'=> 'Descripcion']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fecha_inicio','Fecha de inicio') !!}
                {!! Form::date('fecha_inicio', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fecha_final','Fecha final') !!}
                {!! Form::date('fecha_final', null, ['class' => 'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a class="btn btn-info" href="{{ route('proyectos.index') }}">Volver</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection