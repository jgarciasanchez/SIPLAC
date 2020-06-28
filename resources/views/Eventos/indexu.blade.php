@extends('layouts.app')
@section('content')
@include('profesores.fragment.error')
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">

					<div class="modal-body">
						<div class="text-center">
							<h5 >Nuevo profesor</h5>
						</div>
						{!! Form::open(['route'=>'profesores.store']) !!}
						<div class="row">
							<div class="col-sm-6">

							 </div>
							  <div class="col-sm-6">



									<div class="modal-footer">
											<button type="submit" class="btn btn-success">Enviar</button>
											<a class="btn btn-info" href="{{ route('profesores.index') }}">Volver</a>
									</div>
							</div>
						 {!! Form::close() !!}
						</div>

					</div>

			</div>
		</div>
	  </div>
	 </div>

@endsection
