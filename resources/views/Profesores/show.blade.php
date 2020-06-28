<div id="masDatos" class="modal fade">
	<button type="button" class="close" data-dismiss="modal">
	  							<span>&times;</span>
	</button>
	<div class="row">
		<div class="col-sm-6">
			<div class="modal-dialog">
	  				<div class="modal-content">
	  					<div class="modal-body">
	  						<h5 class="text-center">Proyectos</h5>
	  						<div class="ml-auto col-sm-5">
										<input name="buscarP" type="text" value="{{ old('buscar') }}" name="buscar" class="form-control" placeholder="Nombre proyecto">
							</div>
	  						<table class="table table-striped" >
										<thead class="thead-dark"><th scope="row">Codigo</th><th scope="row">Curso</th><th scope="row">Carrera</th><th  scope="row">Acciones</th></thead>
											<tbody>
											</tbody>
										</table>
	  					</div>		
		   		</div>
	  		</div>	
		</div>
		<div class="col-sm-6">
			<div class="modal-dialog">
	  				<div class="modal-content">
	  					<div class="modal-body">
	  						<h5 class="text-center">Cursos</h5>
	  						<div class="ml-auto col-sm-5">
										<input name="buscarC" type="text" value="{{ old('buscar') }}" name="buscar" class="form-control" placeholder="Nombre curso">
							</div>
	  						<table class="table table-striped" >
										<thead class="thead-dark"><th scope="row">Codigo</th><th scope="row">Curso</th><th scope="row">Carrera</th><th scope="row">Acciones</th></thead>
											<tbody>
											</tbody>
										</table>
	  					</div>			
		   		</div>
	  		</div>	
		</div>
	</div>		
  </div>
