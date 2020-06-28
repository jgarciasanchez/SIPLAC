

var inicioCiclo;
var finCiclo;
var vectorHorarios;//el arreglo de horarios
var vectorHorariosCompleto;//el arreglo de horarios
var eventoClicked;
var eventosEliminar=[];
function insertJson(horariosFiltra,horarios){
  vectorHorarios=horariosFiltra;
  vectorHorariosCompleto = horarios;
}

function cambioCiclo(inicio, final){

  inicioCiclo=inicio;
  finCiclo =final;
       
  console.log(data);

}


function pad(number) {
  if (number < 10) {
    return '0' + number;
  }
  return number;
}

function obtenerEventos(calendar){
  var events =calendar.getEvents();
  var eventsArray = [];
  for (var i = 0; i < events.length; i++) {
    var event ={
      start_time: events[i].start.toLocaleTimeString('it-IT'),
      end_time: events[i].end.toLocaleTimeString('it-IT'),
      day: events[i].start.getDay(),
      title: events[i].title,
      ciclo: events[i].extendedProps.ciclo_id,
      aula: events[i].extendedProps.aula_id,
      curso: events[i].extendedProps.curso_id,
      stored: events[i].extendedProps.stored
    }
    eventsArray.push(event);
  }
  return eventsArray;
}

function obtenerEventosDelete(calendar){
  var events =calendar.getEvents();
  var eventsArray = [];
  for (var i = 0; i < events.length; i++) {
    var event ={
      start_time: events[i].start.toLocaleTimeString('it-IT'),
      end_time: events[i].end.toLocaleTimeString('it-IT'),
      day: events[i].start.getDay(),
      title: events[i].title,
      ciclo: events[i].extendedProps.ciclo_id,
      aula: events[i].extendedProps.aula_id,
      curso: events[i].extendedProps.curso_id,
      stored: events[i].extendedProps.stored
    }
    eventsArray.push(event);
  }
  return eventsArray;
}

    document.addEventListener('DOMContentLoaded', function() {
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable

    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      selectable: true,
      header: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      customButtons: {//----------------------------------------METODO PARA INSERTAR
        miBoton:{
          text: 'Insertar',
          click: function() {
            $("#ModalView1").modal();           
          }
        }
      },
      locale: 'es',
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      selectable: true,
      eventStartEditable:true,
      eventLimit: true,
      selectMirror: true,
      events: vectorHorarios,

      

      eventClick:function(arg){   // Click sobre un evento
        $('#tituloEvento').text(function(i, oldText) {
            return oldText === 'Asignacion a horarios' ? 'Vista horario' : oldText;
        });

        const dateStart = new Date(arg.event.start);
        const dateEnd = new Date(arg.event.end);
        $("#ciclos_select_modal").html($("#ciclos_select").html());
        $("#aulas_select_modal").html($("#aulas_select").html());
        $("#cursos_select_modal").html($("#cursos_select").html());
        $('[id$=lblHini]').text(dateStart.toLocaleTimeString('it-IT'));
        $('[id$=lblHfin]').text(dateEnd.toLocaleTimeString('it-IT'));
        $("#dias").val(dateStart.getDay()); 
        $("#ciclos_select_modal").val(arg.event.extendedProps.ciclo_id).change();
        $("#aulas_select_modal").val(arg.event.extendedProps.aula_id).change();
        $("#cursos_select_modal").val(arg.event.extendedProps.curso_id).change();
        $("#ModalInsercion").modal(); 
        $("#botonInserta").hide();
        $("#botonElimina").show();
        eventoClicked = arg.event.id;
      },

      select: function(arg) {
        //  Este bloque carga la lista de opciones a los select del modal

      },

      drop: function(arg) {
        // is the "remove after drop" checkbox checked?
        
      },
      //events: vectorHorarios, //-------------------------------------------------------SE INSERTA LA INFORMACION DE LOS FILTROS DE HORARIOS DEL INDEX


      dateClick: function(info) { //CLICK SOBRE UNA FECHA SIN ENVENTO DEL CALENDARIO
         //$("#ModalView1").modal();
         //calendar.addEvent({title:"Evento x",date:info.dateStr,startTime:"08:30:00",endTime:"12:00:00",daysOfWeek:"5", ciclo_id:"4"}); ESTO ES UNA FORMA DE INSERTAR EN EL HORARIO ACTUAL
      }
    });
    calendar.render();
    
    $("#btnGuardar").click(function (e) {  //Metodo que toma todos los eventos del calendario y los envia para ser almacenados en la base de datos
      var eventos = obtenerEventos(calendar);
      var url = 'ajaxSolicitud';

      enviaJSON(url,eventos,calendar);

    });

    $("#btnDescartar").click(function (e) {  //Metodo que toma todos los eventos del calendario y los envia para ser almacenados en la base de datos
      alert('No se guardaron los cambios');

    });

    $("#botonInserta").click(function(e){ // emtodo que inserta en el calendario de manera local
      
      
      if($("#cursos_select_modal option:selected").val()!="Ninguno"){

        calendar.addEvent({
        stored:'no',
        title:$("#cursos_select_modal option:selected").text(),
        startTime: $('#lblHini').text(),
        endTime: $('#lblHfin').text(),
        curso_id:$("#cursos_select_modal option:selected").val(),
        ciclo_id:$("#ciclos_select_modal option:selected").val(),
        aula_id:$("#aulas_select_modal option:selected").val(),
        startRecur: $("#ciclos_select_modal option:selected").data("start"),
        endRecur:$("#ciclos_select_modal option:selected").data("end"),
        color: $("#cursos_select_modal option:selected").data("color"),
        id: $("#cursos_select_modal option:selected").data("nrc")+[ $('select[name=dias]').val()],
        daysOfWeek: [ $('select[name=dias]').val()],

      });

    }

    }); 

    $("#botonElimina").click(function(e){ // emtodo que inserta en el calendario de manera local
     
       //$('#calendar').fullCalendar('removeEvents',eventoClicked);
      var eventSources = calendar.getEvents();
      var len = eventSources.length;
      console.log(eventSources);
      console.log("-----");
      for (var i = 0; i < len; i++) { 
        if(eventSources[i].id==eventoClicked){
          console.log(eventSources[i].id+"-"+eventoClicked);
          eventosEliminar.push(eventSources[i].id);
          eventSources[i].remove(); 
        }
      } 
      console.log(eventosEliminar);

    }); 
  });



  function enviaJSON(pRuta,pDatos,calendario){
    var datos = pDatos;
    var url = pRuta;
    var datosJSON = JSON.stringify(datos);
    var datosJSON2 = JSON.stringify(eventosEliminar);


    //e.preventDefault();
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
  
    jQuery.ajax({
      url: url,
      method: 'POST',
      data: {datosArray:datosJSON, "jsondata": datosJSON2},
      success:function(result){
        
      }}).done(function(data){
        resultadoRequestAjax(calendario,data);
      });
    
  }

  function cleanCalendar(calendario){
    var eventSources = calendario.getEvents();
    var len = eventSources.length;

    for (var i = 0; i < len; i++) { 
      eventSources[i].remove(); 
    } 

    calendario.render();
  }


  function  resultadoRequestAjax(calendario,respuestaController){

    var respuesta = JSON.stringify(respuestaController);
    var parseRespuesta = JSON.parse(respuesta);
    var errores = 'Se han encontrado los siguientes errores en su solicitud :';
    console.log(parseRespuesta);
      if(parseRespuesta.length == 0){

        alert('Su solicitud se realizo con exito');
        cleanCalendar(calendario);
      }

      else{
        for(var i = 0; i < parseRespuesta.length;i++){
          errores = errores + parseRespuesta[i].mensaje.toString() + '';
       }
 
      alert(errores);
      }


    }
