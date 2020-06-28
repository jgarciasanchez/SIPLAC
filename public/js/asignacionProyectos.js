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
      //events: vectorHorarios,

      

      eventClick:function(arg){   // Click sobre un evento


      },

      select: function(arg) {

        $("#ModalInsercion").modal(); 
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


    });

    $("#botonInserta").click(function(e){ // emtodo que inserta en el calendario de manera local
      

    }); 



  });
