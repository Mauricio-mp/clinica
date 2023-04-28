
$( document ).ready(function() {
    $.post("index.php?page=cita&op=empleado", {
    }, function(response) {
    
      var json=JSON.parse(response);
      for (let i = 0; i < json.length; i++) {
        const element = json[i]['cempno'];
        const nombre = json[i]['cfname']+''+json[i]['clname'];
        $('#cbxCita').append($('<option>').val(element).text(nombre));
      }
    
    });
});


function buscarEmpleado() {
  alert('hola');
}

function cambio(e) {
 
  switch (e.target.value) {
    case 'Codigo':
      $('.empleadoCodigo').show();
      $('.NOmbre_EmpleDO').hide();
      $('.identidad').hide();

      break;
    case 'nombre':
      $('.NOmbre_EmpleDO').show();
      $('.identidad').hide();
      $('.empleadoCodigo').hide();
    break;
    case 'identidad':
      $('.identidad').show();
      $('.empleadoCodigo').hide();
      $('.NOmbre_EmpleDO').hide();
    break;
    default:
      break;
  }
}

