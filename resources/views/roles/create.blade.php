@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class=" col-md-12">  
       	@include('mensajes.info')
       	@include('mensajes.error')
            <div class="col-md-12 text-center">
                <h5>Crear Roles</h5>
            </div>                  
            {{ Form::open(['route' => 'roles.store']) }}
                @include('roles.partials.form')
            {{ Form::close() }}
    </div>
</div>
@endsection