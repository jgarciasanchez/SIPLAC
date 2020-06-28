@extends('layouts.app')
@section('content')
@include('aulas.fragment.error')
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">

					<div class="modal-body">
						<div class="text-center">
							<h5 >Nueva Aula</h5>
						</div>
						{!! Form::open(['route'=>'aulas.store']) !!}
						<div class="row">
							<div class="col-sm-6">
							   		@include('aulas.fragment.form')
							 </div>
						 {!! Form::close() !!}
						</div>

					</div>

			</div>
		</div>
	  </div>
	 </div>

@endsection
