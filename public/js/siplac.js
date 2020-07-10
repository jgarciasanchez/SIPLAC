
  function enviaJSON(pRuta,pDatos){
    var url = pRuta;
    var datos = pDatos;
    var datosJSON = JSON.stringify(datos);

    //e.preventDefault();
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
  
    jQuery.ajax({
      url: url,
      method: 'POST',
      data: {datosArray:datosJSON},
      success:function(result){
        
      }}).done(function(data){
        //resultadoRequestAjax(calendario,data);
      });
    
  }

  function setCarrera(){

    var carrera = $("#select_carrera option:selected").val();
    enviaJSON('carrera/'+carrera);

  }