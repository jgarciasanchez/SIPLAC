$('#search').on('keyup', function() {
    console.log('jaj');
    $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '{{Route("proyecto_busqueda")}}',
        data: {'search': $value},
        success: function(data) {
            console.log(data);
            $('#tbody_Proy').html(data);
        }
    })
}) 