$('#BtnGuardarIncapacidad').click(function() {
   var FechaInicio=$('#FechaInicio').val();
   var FechaFin=$('#FechaFin').val();
   var txtNombre=$('#txtNombre').val();
   var textCertificado=$('#textCertificado').val();
   var textObservacion=$('#textObservacion').val();
   var txtCodigoPatronal=$('#txtCodigoPatronal').val();
   var textdias=$('#textdias').val();
   var queryString = window.location.search; 
   
   var urlParams = new URLSearchParams(queryString); 
   var id = urlParams.get('id');

   var InicioFecha = moment(FechaInicio).format('YYYY-MM-DD');
   var FinFecha = moment(FechaFin).format('YYYY-MM-DD');
 
   $.post("index.php?page=generar&op=Guardar", {
      id:id,
      FechaInicio:InicioFecha,
      FechaFin:FinFecha,
      txtNombre:txtNombre,
      textCertificado:textCertificado,
      textObservacion:textObservacion,
      txtCodigoPatronal:txtCodigoPatronal,
      textdias:textdias
  }, function(response) {
    if(response==true){
      $('#labeltotal').text('0.00');
      $('#FormIncapacidad').trigger("reset");
      showSuccessToast('Ingresado con exito');
    }else{
      
 
      showDangerToast(response);
    }
  });

});
$('#textdias').keyup(function () {
  var FechaInicio=$('#FechaInicio').val();
  var FechaFin=$('#FechaFin').val();
  var textdias=$('#textdias').val();

  Actualizar(FechaInicio,FechaFin,textdias);
});

$('#FechaInicio').change(function() {
   var FechaInicio=$('#FechaInicio').val();
   var FechaFin=$('#FechaFin').val();

   var NowMoment = moment(FechaInicio).format('YYYY-MM-DD');
   var Fin = moment(FechaFin).format('YYYY-MM-DD');
  
   var fechaini = new Date(NowMoment).getTime();
var fechaFinal    = new Date(Fin).getTime();

var diff = fechaFinal - fechaini;

var dias=diff/(1000*60*60*24) + 1;
$('#textdias').val(dias);




});


$('#FechaFin').change(function() {
   var FechaInicio=$('#FechaInicio').val();
   var FechaFin=$('#FechaFin').val();

   var NowMoment = moment(FechaInicio).format('YYYY-MM-DD');
   var Fin = moment(FechaFin).format('YYYY-MM-DD');
  
   var fechaini = new Date(NowMoment).getTime();
var fechaFinal    = new Date(Fin).getTime();

var diff = fechaFinal - fechaini;

var dias=diff/(1000*60*60*24) + 1;
$('#textdias').val(dias);


Actualizar(FechaInicio,FechaFin,dias);

});




function Actualizar(FechaInicio,FechaFin,dias) {
  $.post("index.php?page=generar&op=ActualizarSueldo", {

    FechaInicio:FechaInicio,
    FechaFin:FechaFin,
    textdias:dias
  }, function(response) {
  
    
  
    $('#labeltotal').text(response);
  
  });
}