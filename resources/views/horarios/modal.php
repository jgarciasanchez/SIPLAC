
  <!-- Modal Guardado---------------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="modal fade" id="ModalInsercion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <form name="form" action="" method="get">
          <h5 class="modal-title"   name="tituloEvento" id="tituloEvento">Asignacion a horarios</h5>
        </form>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php //echo $variableIdH  ?>
      <div class="modal-body"> 
     
      {!! Form::open(['route'=>'eventos.store']) !!} 
        <div class="row">
           <div class="col-sm-6">
              <div class="form-group"> <!--Cursos modal  -->
                {!! Form::label('cursos','Curso') !!}
                <select name="cursos_idM" id="cursos_idM" class="form-control" >
                  <option id="cursoDef1" value="Ninguno">Ninguno</option>
                  @foreach ($cursos as $item)
                        <option value="{{$item->id}}">{{$item->nombre_cur.' ('.$item->nrc.')'}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                {!! Form::label('aula','Aula') !!} <!---------------Seleccion de Aulas Modal------------>
                <select name="aula_idM" id="aula_idM" class="form-control">
                  <option id="aulaDef1" value="Ninguno">Ninguno</option>
                  @foreach ($aulas as $item)
                      <option value="{{$item->id}}">{{$item->numero}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                {!! Form::label('ciclos','Ciclo') !!}<!---------------Seleccion de ciclo Modal------------>
                <select name="ciclos_idM" id="ciclos_idM" class="form-control">
                  <option id="cicloDef1" value="Ninguno">Ninguno</option>
                  @foreach ($ciclos as $item)
                      <option value={{$item->id}}>{{'Ciclo:'.$item->ciclo.'  ('.$item->año.')'}}</option>
                  @endforeach
                </select>
              </div>


              <div class="form-group">
                {!! Form::label('dias','dias') !!}<!---------------Seleccion de dias Modal------------>
                <select name="dias" id="dias" class="form-control">
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miercoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sabado</option>
                    <option value="7">Dominto</option>
                </select>
              </div>

              <div class="form-group"> 
                  <label>Horas del curso:</label>
                  <label id="lblHorasN"></label>
              </div>
              <div class="form-group"> 
                  <label>Horas asignadas:</label>
                  <label id="lblHorasUseN"></label>
              </div>
            </div>

          <div class="col-sm-6">
            <div class="form-group">

              <div class="form-group">
                <label>Hora ini:</label>
                <label id="lblHini"></label>
              </div>
               <div class="form-group">
                  <label>Hora fin:</label>
                  <label id="lblHfin"></label>
              </div>

            </div>           
          </div>
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Asignar</button> 
            <a class="btn btn-info" class="close" data-dismiss="modal" >Volver</a>
      </div> 
     </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
