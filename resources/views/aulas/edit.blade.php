@extends('layouts.app')
@section('content')
@include('aulas.fragment.error')
	<div class="shadow-lg">
		<div class="row">
			<div class="col-md-12">
			<div class="modal-content ">

					<div class="modal-body">
						<div class="text-center">
							<h5 >Editar Aula</h5>
						</div>
						{!! Form::model($aula,['route'=>['aulas.update',$aula->id],'method'=>'PUT']) !!}
						<div class="row">
							<div class="col-sm-6">
							   		@include('aulas.fragment.form2')
							 </div>
						 {!! Form::close() !!}
						</div>

					</div>

			</div>
		</div>
	  </div>
	 </div>

@endsection
