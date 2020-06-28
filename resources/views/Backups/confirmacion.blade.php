
<div id="confirmarEliminar" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-body">
          <div  class="row"> 
          <div class="align-content-center col-sm-12"> 
                <h5 class="text-center">¿Esta seguro que desea eliminiar?</h5>
          </div>
           </div>         
           <div class="modal-footer col-sm-12">
           		@can('backups.destroy')
	                <button type="button" onclick="eliminarBackups()" class="btn btn-danger" data-dismiss="modal">
	                    Aceptar
	                </button>
                @endcan
                  <button type="button" class="btn btn-info" data-dismiss="modal">
                    Cancelar
                  </button>
            </div>   
      </div> 
    </div>
  </div> 
</div>

