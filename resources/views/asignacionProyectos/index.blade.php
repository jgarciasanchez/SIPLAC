@extends('layouts.app')

@section('content')

<html>
<head>
<meta charset='utf-8' />
<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
<link href='css/asignacionProyectos.css' rel='stylesheet' />
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/core/locales-all.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'   ></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'  ></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'  ></script>
<script src='js/asignacionProyectos.js'  ></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />



<body>

  <div class="row">

    <div  class="col-3">


      <div class="form-group">
              <button type="submit" id='btnGuardar' class="btn btn-success btn-sm">
                Guardar Proyecto
              </button>
      </div>

      @include('usuarios.fragment.info')
      
      {!! Form::open(['route'=>'horario.index','method'=>'GET','class'=>'','id'=>'frm-insert']) !!}
      <br>
      <div id='external-events'> <!---- CODIGO CALENDAR LLAMADO A UNAS FUNCIONES --------------------------------------------->
            

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


</div>

</div>

</body>


@endsection