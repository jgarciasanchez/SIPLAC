@extends('layouts.app')
@section('content')
@include('cursos.fragment.error')
<div class="modal-dialog shadow-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h5>Editar curso</h5>
		</div>
		<div class="modal-body">
			{!! Form::model($cursos,['route'=>['cursos.update',$cursos->id],'method'=>'PUT']) !!}
			<div class="form-group">
				{!! Form::label('nombre_cur','Nombre de Carrera') !!}
				{!! Form::text('nombre_cur',old('nombre_cur'),['class'=>'form-control','placeholder'=> 'Nombre Curso']) !!}

				{!! Form::label('codigo','Codigo') !!}
				{!! Form::text('codigo',old('codigo'),['class'=>'form-control','placeholder'=> 'Codigo Curso']) !!}

				{!! Form::label('creditos','Creditos') !!}
				{!! Form::text('creditos',old('creditos'),['class'=>'form-control','placeholder'=> 'Creditos del curso']) !!}

				{!! Form::label('horas','Horas') !!}
				{!! Form::text('horas',old('horas'),['class'=>'form-control','placeholder'=> 'Horas']) !!}

				{!! Form::label('horas_contacto','Horas contacto') !!}
				{!! Form::text('horas_contacto',old('horas_contacto'),['class'=>'form-control','placeholder'=> 'horas_contacto']) !!}

				<div class="form-group">
					{!! Form::label('are_id','Area Academica') !!}
					<select name="are_id" class="form-control">
						<option value={{$areaAct->id}}>{{$areaAct->nombreArea}}</option>
						@foreach ($list as $item)
						<option value={{$item->id}}>{{$item->nombreArea}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					{!! Form::label('color','Color') !!}

					<div class="form-inline">
						<div class="color-picker "></div>
						<input class="form-control ml-2" type="text" name='color' id="color" value="{{ $cursos->color }}"/>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('carrera_id','Carrera') !!}
					<select name="carrera_id" class="form-control">
						<option value={{$carreraAct->id}}>{{$carreraAct->nombre}}</option>
						@foreach ($carreras as $item)
						<option value={{$item->id}}>{{$item->nombre}}</option>
						@endforeach
					</select>
				</div>

				{!! Form::label('estado','Estado (Activo/inactivo)') !!}
				{!! Form::checkbox('estado' , null , $cursos->estado=="A"?true:false) !!}

				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Guardar</button>
					<a class="btn btn-info" href="{{ route('cursos.index') }}">Volver</a>
				</div>

				{!! Form::close() !!}
			</div>
		</div>

		<script type="text/javascript">
			$('.colorpicker').colorpicker({});

			let txtColor = document.getElementById("color");


			const pickr = Pickr.create({
				el: '.color-picker',
				theme: 'nano', // or 'monolith', or 'nano'

				swatches: [
					'rgba(244, 67, 54, 1)',
					'rgba(233, 30, 99, 1)',
					'rgba(156, 39, 176, 1)',
					'rgba(103, 58, 183, 1)',
					'rgba(63, 81, 181, 1)',
					'rgba(33, 150, 243, 1)',
					'rgba(3, 169, 244, 1)',
					'rgba(0, 188, 212, 1)',
					'rgba(0, 150, 136, 1)',
					'rgba(76, 175, 80, 1)',
					'rgba(139, 195, 74, 1)',
					'rgba(205, 220, 57, 1)',
					'rgba(255, 235, 59, 1)',
					'rgba(255, 193, 7, 1)'
				],

				components: {

					// Main components
					preview: true,
					opacity: false,
					hue: true,

					// Input / output Options
					interaction: {
						hex: true,
						rgba: false,
						hsla: false,
						hsva: false,
						cmyk: false,
						input: true,
						clear: false,
						save: false
					}
				}


			});

			pickr.on('changestop', (...args) => {
				let color1 = args[0]._color.toHEXA()[0];
				let color2 = args[0]._color.toHEXA()[1];
				let color3 = args[0]._color.toHEXA()[2];
				let color = color1 + color2 + color3;
				txtColor.value = "#" + color;
			}).on('change', (...args) => {
				let color1 = args[0].toHEXA()[0];
				let color2 = args[0].toHEXA()[1];
				let color3 = args[0].toHEXA()[2];
				let color = color1 + color2 + color3;
				pickr.setColor("#" + color);
			}).on('init', (...args) => {
				pickr.setColor(txtColor.value);
			});
		</script>
		@endsection