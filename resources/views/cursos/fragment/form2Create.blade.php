<div class="form-group">
	{!! Form::label('estado','Estado (Activo/inactivo)') !!}
	{!! Form::checkbox('estado' , null ,false) !!}

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
	{!! Form::label('color','Color') !!}

	<div class="form-inline">
		<div class="color-picker "></div>
		<input class="form-control ml-2" type="text" name='color' id="color" />
	</div>


</div>

</div>
</div>

<div class="modal-footer">
	@can('cursos.create')<button type="submit" class="btn btn-success">Enviar</button>@endcan
	<a class="btn btn-info" href="{{ route('cursos.index') }}">Volver</a>
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
	});
</script>

