@extends('layouts.app')

@section('content')

<html>
<head>
<meta charset='utf-8' />
<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
<link href='css/fullcalendar.css' rel='stylesheet' />
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/core/locales-all.js')}}'  ></script>

<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>

<script src='js/jquery.min.js'  ></script>  <!--prueba-->
<script src='js/FullCalendar.js'  ></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>

  <div class="col-md-12">

    <div class="row pt-9">
         {!! Form::open(['route'=>'eventos.index','method'=>'GET','class'=>'form-inline','id'=>'frm-insert']) !!}
          @csrf

          <div class="modal-footer">
            <a class="btn btn-info" class="close" id="listoTodo" data-dismiss="modal" >Listo!</a>
          </div> 

          <div class="form-group">      <!---------------Seleccion de Cursos filtro------------->
            {!! Form::label('cursos','Curso') !!}
            <select name="cursos_id" id="cursos_id" class="form-control">
              <option>Ninguno</option>
              @foreach ($cursos as $item)
                    <option value="{{ $item->id}}">
                      @if (request('cursos_id') == $item->id) selected @endif{{$item->nombre_cur.' ('.$item->nrc.')'}}
                    </option>
              @endforeach
            </select>
          </div>&nbsp

          <div class="form-group">
            {!! Form::label('aula','Aula') !!} <!---------------Seleccion de Aulas filtro------------->
            <select name="aula_id" id="aula_id" class="form-control">
              <option>Ninguno</option>
              @foreach ($aulas as $item)
                  <option value="{{$item->id}}">
                    @if (request('aula_id') == $item->id) selected @endif{{$item->numero}}
                  </option>
              @endforeach
            </select>
          </div>&nbsp

          <div class="form-group">
            {!! Form::label('ciclos','Ciclo') !!}<!---------------Seleccion de ciclo filtro------------->
            <select name="ciclo_id" id="ciclo_id"  class="form-control">
              <option>Ninguno</option>
              @foreach ($ciclos as $item)
                  <option value="{{$item->id}}">
                    @if (request('aula_id') == $item->id) selected @endif{{'Ciclo:'.$item->ciclo.'  ('.$item->año.')'}}
                  </option>
              @endforeach
            </select>
          </div>&nbsp



          <div class="form-group">
            {!! Form::label('grupos','grupos') !!}<!---------------Seleccion de grupo filtro------------->
            <select name="grupo_id" id="grupo_id" class="form-control">
              <option>Ninguno</option>
              @foreach ($grupos as $item)
                  <option value="{{$item->id}}">
                    @if (request('grupo_id') == $item->id) selected @endif{{$item->numero}}
                  </option>
              @endforeach
            </select>
          </div>&nbsp

          <div class="form-group">
            {!! Form::label('Carreras','carreras') !!}<!---------------Seleccion de carrera filtro------------->
            <select name="carrera_id" id="carrera_id" class="form-control">
              <option>Ninguno</option>
              @foreach ($carrera as $item)
                  <option value="{{$item->id}}">
                     @if (request('carrera_id') == $item->id) selected @endif{{$item->nombre}}
                  </option>
              @endforeach
            </select>
          </div>&nbsp

          <div class="form-group">
            {!! Form::label('Nivel','nivel') !!} <!---------------Seleccion de Nivel filtro------------->
            <select  name="nivel_id" id="nivel_id" class="form-control">
              <option>Ninguno</option>
              @foreach ($nivel as $item)
                  <option value="{{$item}}">
                    @if (request('nivel_id') == $item) selected @endif{{$item}}
                  </option>
              @endforeach
            </select>
          </div>&nbsp

          <br>
          <div class="form-group">
            <button type="submit" class="btn  btn-info">
              Buscar
            </button>
          </div>
         {!! Form::close() !!}
    </div>

    <br>
      <br>
        <br>


  {!!Form::open([''])!!}
  <div class="form-group">
      <script language="javascript" type="text/javascript"> // INSERTA EN ELSJON AL EJECUTAR LA VISTA DE FORMA QUE FULLCALENDAR LO USE
          var obj = <?php echo json_encode($horarios); ?>;
          var horario = <?php echo json_encode($HorariosTodos); ?>;
          insertJson(obj,horario);
      </script>
  </div>
  {!!Form::close()!!}

  <div id='wrap'>
    <div id='calendar'></div>
    <div style='clear:both'></div>
  </div>

</div>


<script> // GUTI SI DEJA ESO LE IMPRIME EL ARCHOVI JSON------------------------------------------------------ es el   
    function prueb222(){
      <?php $variableIdH = "444"?> 
      <?php echo  $variableIdH;?>
      <?php $variableIdH = "444"?> 
      alert("bbbb");
    }
    
    function prueb111(){
      <?php $variableIdH = "2222"?> 
      <?php echo  $variableIdH;?>
      <?php $variableIdH = "2222"?> 
      alert("aaaaa");
    }            
</script>



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
     
      {!! Form::open(['route'=>'eventos.store']) !!} <!-- {!! Form::model($horarios,['route'=>['eventos.store',$variableIdH],'method'=>'PUT']) !!}-->
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
                  <option id="aulaDef1" value="" >Ningunos</option>
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
            <a  id= "botonInserta" class="btn btn-info" class="close" data-dismiss="modal" >Insertar</a>
            <a class="btn btn-info" class="close" data-dismiss="modal" >Volver</a>
      </div> 
     </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

<!-- Modal EDICION---------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="ModalView2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <form name="form" action="" method="get">
          <h5 class="modal-title"   name="idHorario" id="idHorario"></h5>
        </form>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--{!! Form::model($cursos,['route'=>['eventos.update',$variableIdH],'method'=>'PUT']) !!}-->
      <div class="modal-body"> 
        <div class="row">
           <div class="col-sm-6">
            <div class="form-group"> 
                <label>Horas del curso:</label>
                <label id="lblHoras"></label>
            </div>
            <div class="form-group">
                <label>Hora ini:</label>
                <label id="lblHini"></label>
            </div>
             <div class="form-group">
                <label>Hora fin:</label>
                <label id="lblHfin"></label>
            </div>
            <div class="form-group">
                <label>Horas asignadas:</label>
                <label id="lblHorasUse"></label>
            </div>
            {!! Form::label('HInicio','HInicio') !!} <!---------------Seleccion de Horas inicio Modal------------>
            <select name="Hinicio2" id="Hinicio2" class="form-control">
              <option id="HinicioDef">Ninguno</option>
              @foreach ($horas as $item)
                  <option value={{$item}}>{{$item}}</option>
              @endforeach
            </select>
            {!! Form::label('MInicio','MInicio') !!}  <!---------------Seleccion de minutos Modal------------>
            <select name="Minicio2" id="Minicio2" class="form-control">
              <option id="MinicioDef">Ninguno</option>
              @foreach ($minutos as $item)
                  <option value={{$item}}>{{$item}}</option>
              @endforeach
            </select>
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
          </div>  

          <div class="col-sm-6">
            {!! Form::label('dias','Dias') !!}<!---------------Seleccion de dias Modal------------>
            <select name="dias2" id="dias2" class="form-control">
                <option id="diaDef">Ninguno</option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miercoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sabado</option>
                <option value="7">Dominto</option>
            </select>

            {!! Form::label('cursos','Curso') !!}
            <select name="cursos_idM2" id="cursos_idM2" class="form-control">
              <option id="cursoDef">Ninguno</option>
              @foreach ($cursos as $item)
                    <option value="{{$item->id}}">{{ $item->nombre_cur.' ('.$item->nrc.')' }}</option>
              @endforeach
            </select>       
            {!! Form::label('aula','Aula') !!} <!---------------Seleccion de Aulas Modal------------>
            <select name="aula_idM2" id="aula_idM2" class="form-control">
              <option id="aulaDef">Ninguno</option>
              @foreach ($aulas as $item)
                  <option value="{{$item->id}}">{{$item->numero}}</option>
              @endforeach
            </select>   
            {!! Form::label('ciclos','Ciclo') !!}<!---------------Seleccion de ciclo Modal------------>
            <select name="ciclos_idM2" id="ciclos_idM2" class="form-control">
              <option id="cicloDef">Ninguno</option>
              @foreach ($ciclos as $item)
                  <option value={{$item->id}}>{{'Ciclo:'.$item->ciclo.'  (fecha I:   '.$item->fecha_inicio.')   (Fecha F:   '.$item->fecha_fin.')'}}</option>
              @endforeach
            </select>        
          </div>
          <div class="col-sm-6">
                       
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-submit">Realizar Cambio</button>
        <a class="btn btn-info" class="close" data-dismiss="modal" >Listo!</a>
      </div> 
   <!---{!! Form::close() !!}-->
  </div>
</div>
</div>

</body>


</html>



@endsection
