

function ReporteGeneral()
 {
var form= $('#FormularioReportegeneral').serialize();

$.ajax({
    type: "POST",
    url: "index.php?page=reporteGeneral&op=mostrar&"+form,
    data: '',
    success: function (response) {
        console.log(response);
    }
});
}


$('#todos' ).on( 'click', function() {
    if( $(this).is(':checked') ){
        // Hacer algo si el checkbox ha sido seleccionado
        //alert("El checkbox con valor " + $(this).val() + " ha sido seleccionado");
        $( '#container input[type="checkbox"]' ).prop('checked', this.checked)
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        $( '#container input[type="checkbox"]' ).prop('checked', false)
    }
});

