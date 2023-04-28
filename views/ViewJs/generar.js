var Identy=0;
var idGlobal=0;
var CodigoGlobal=0;
var name=0;
function mostrar(identidad,Codigo,nombre,apellido) {

    $('#demoModal').modal("show");
    Identy=identidad;
    name=nombre+'\t'+apellido;
    CodigoGlobal=Codigo;
 }
  function EnvioFOrm(params) {
  console.log(name.trim());
  // ValidarUsuario(Identy);
    //showDangerToast(params);
 
    var arr = $('[name="radio[]"]:checked').map(function(){
        return this.value;
      }).get();
      
      var str = arr.join(',');
      
      
      if(str==''){
        $('#str').text('* Favor Ingresar Una opcion');
      }else{
        $('#str').text('');

        $.post("index.php?page=generar&op=ConsultarDias", {
          identidad:Identy
      }, function(response) {
        if(response==true){
          window.location.href='index.php?page=Ingreso&Tipo='+str+'&id='+Identy+'&codigo='+CodigoGlobal+'&name='+name 
        }else{
          showDangerToast('El usuario ya excedio los 6 dias habiles');
        }
              
          
          
      });
      
      }
      
      
      
 }
 function Agregar(){
    showDangerToast("Fecha Vacia");
    $('#divIdentidad').hide();
}

function ValidarUsuario(iden) {
  $.post("index.php?page=generar&op=validarUsuario", {
    identidad:iden
}, function(response) {
  
        showSuccessToast(response);
    
    
});
}

 function TipoOpcion() {
    var tipo= $('#chkTipoBusqueda').val();
    $('#Valor').val('');
    if(tipo==0){
    $('#LabelValor').text('Ingrese Identidad');
    $('#Valor').attr("placeholder", "####-####-#####");
    
    }else if(tipo==1){
    $('#LabelValor').text('Ingrese Nombre');
    $('#Valor').attr("placeholder", "Nombre");
    }else if(tipo==2){
    $('#LabelValor').text('Ingrese Apellido');
    $('#Valor').attr("placeholder", "Apellido");
    }else if(tipo==3){
    $('#LabelValor').text('Ingrese Codigo de Empleado');
    $('#Valor').attr("placeholder", "Codigo");
    }
    
}