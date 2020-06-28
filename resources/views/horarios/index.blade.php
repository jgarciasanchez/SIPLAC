@extends('layouts.app')

@section('content')

<html>
<head>
<meta charset='utf-8' />
<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
<link href='css/fullcalendar2.css' rel='stylesheet' />
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/core/locales-all.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>
<script src='js/fullcalendar2.js'></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<body>

  <div class="row">

    <div  class="col-3">


      <div class="form-group">
              <button type="submit" id='btnGuardar' class="btn btn-success btn-sm">
                 Guardar Horario
              </button>

             <button type="submit" id='btnDescartar' class="btn btn-danger btn-sm">
                Descartar Cambios
              </button>
      </div>
      @include('usuarios.fragment.info')
      
      {!! Form::open(['route'=>'horario.index','method'=>'GET','class'=>'','id'=>'frm-insert']) !!}
      <br>
      <div id='external-events'> <!---- CODIGO CALENDAR LLAMADO A UNAS FUNCIONES --------------------------------------------->
            <div class="form-group">      <!---------------Seleccion de Cursos filtro------------->
              {!! Form::label('cursos','Curso') !!}
              <select name="cursos_select" id="cursos_select" class="form-control">
                <option>Ninguno</option>
                @foreach ($cursos as $item)
                      <option data-color="{{$item->color}}" data-nrc="{{$item->nrc}}" value="{{ $item->id}}">
                        @if (request('cursos_id') == $item->id) selected @endif{{$item->nombre_cur.' ('.$item->nrc.')'}}
                      </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              {!! Form::label('grupos','Grupo') !!}<!---------------Seleccion de grupo filtro------------->
              <select name="grupos_select" id="grupos_select" class="form-control">
                <option>Ninguno</option>
                @foreach ($grupos as $item)
                    <option value="{{$item->id}}">
                      @if (request('grupo_id') == $item->id) selected @endif{{$item->numero}}
                    </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              {!! Form::label('aula','Aula') !!} <!---------------Seleccion de Aulas filtro------------->
              <select name="aulas_select" id="aulas_select" class="form-control">
                <option>Ninguno</option>
                @foreach ($aulas as $item)
                    <option value="{{$item->id}}">
                      @if (request('aula_id') == $item->id) selected @endif{{$item->numero}}
                    </option>
                @endforeach
              </select>
            </div>

              <div class="form-group">
                {!! Form::label('ciclos','Ciclo') !!}<!---------------Seleccion de ciclo Modal------------>
                <select name="ciclos_select" id="ciclos_select" class="form-control" >
                  <option>Ninguno</option>
                  @foreach ($ciclos as $item)
                    <option data-start="{{$item->fecha_inicio}}" data-end="{{$item->fecha_fin}}"  value="{{$item->id}}">{{'Ciclo:'.$item->ciclo.'  ('.$item->año.')'}}</option>
                  @endforeach
                </select>
              </div>

            <br>
            <div class="form-group">
              <button type="submit" class="btn  btn-info">
                Buscar
              </button>
            </div>
          {!! Form::close() !!}
    </div>
    </div>  

    <div class="col-9" id='calendar'>

    </div>

  </div>

   {!!Form::open([''])!!}
  <div class="form-group">
      <script language="javascript" type="text/javascript"> // INSERTA EN ELSJON AL EJECUTAR LA VISTA DE FORMA QUE FULLCALENDAR LO USE
          var obj = <?php echo json_encode($horarios); ?>;
          var horario = <?php echo json_encode($HorariosTodos); ?>;
          insertJson(obj,horario);
      </script>
  </div>
  {!!Form::close()!!}


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
     
        <div class="row">
           <div class="col-sm-6">
              <div class="form-group"> <!--Cursos modal  -->
                {!! Form::label('cursos','Curso') !!}
                <select name="cursos_select_modal" id="cursos_select_modal" class="form-control" ></select>
              </div>

              <div class="form-group">
                {!! Form::label('aula','Aula') !!} <!---------------Seleccion de Aulas Modal------------>
                <select  name="aulas_select_modal" id="aulas_select_modal" class="form-control"></select>
              </div>

              <div class="form-group">
                {!! Form::label('ciclos','Ciclo') !!}<!---------------Seleccion de ciclo Modal------------>
                <select  id="ciclos_select_modal" id="ciclos_select_modal"  class="form-control"></select>
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
                    <option value="0">Dominto</option>
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
            <button id= "botonElimina" type="submit" class="btn btn-success" data-dismiss="modal" >Eliminar</button> 
            <button id= "botonInserta" type="submit" class="btn btn-success" data-dismiss="modal" >Asignar</button> 
            <a class="btn btn-info" class="close" data-dismiss="modal" >Volver</a>
      </div> 

     </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

</div>

</body>


@endsection