@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="col-md-12">
	<div class="row">
		<div class="mr-auto form-inline mt-3">
			@can('backups.create')
			<button type="button" onclick="crearBackup()" class="btn btn-success">
				Crear Respaldo
			</button>
			@endcan
		</div>
	</div>

	<div class="row pt-5">
		<div class="modal-content ">
			<div class="modal-body">
				<div class="text-center">
					@include('mensajes.info')
					@include('mensajes.error')

					<table id="backupsTable" class="table table-hover table-striped">
						<thead class="thead-dark">
							<th scope="row">Nombre</th>
							<th scope="row">Tamaño en Megabyte</th>
							<th scope="row">Acciones</th>
						</thead>
						<tbody>
							@foreach ($backups as $item)
								<tr>
									<td>{{ $item->nombre}}</td>
									<td>{{ round($item->tamaño, 2)}}</td>
									<td class="row">
										@can('backups.download')
										<a class="btn btn-primary" href="{{ route('backups.download',$item->nombre) }}">
												Descargar
										</a>&nbsp
										@endcan
										@can('areaacademica.create')
										@can('backups.destroy')
											 <button type="button" onclick="confirmar('{{$item->nombre}}')" class="btn 		btn-danger" >
							                    Eliminar
							                </button>
						                @endcan
						                @endcan
						  
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@include('Backups.confirmacion')
				@include('Backups.cargando')
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	var table = $('#backupsTable').DataTable({
		"columns": [
			null,
			null,
			{
				"width": "15%"
			}
		],
		"sScrollX": "100%",
		"sScrollXInner": "100%",
	});
</script>

@endsection

<script src="{{ asset('js/axios.js') }}" defer></script>

<script type="">
	// cidigo para eliminar con animacion de carga
	var file_name = "";
function confirmar($nom){
	this.file_name = $nom;
	$('#confirmarEliminar').modal('show');
}
function cancelar(){
	$('#confirmarEliminar').modal('hide');
}
function eliminarBackups(){
	 var url = "{{url('backups')}}/"+file_name+"";
	 $('#cargandoId').modal('show');
	 	axios.delete(url).then(response =>{    
	 		toastr.success('Backups eliminado correctamente');
              location.reload(); 
        }).catch(error=> {
            toastr.error('El backups no se ha podido eliminar correctamente');
        });

	}
function crearBackup(){
	 var url = "{{url('backups')}}/store";
	 	$('#cargandoId').modal('show');

	 	axios.post(url).then(response =>{    
	 		toastr.success('Backups Creado correctamente');
            location.reload(); 
        }).catch(error=> {
            toastr.error('El backups no se ha podido crear correctamente');
        });

	}

</script>