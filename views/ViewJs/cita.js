

$( document ).ready(function() {
  /*$('.form_DatosGenerales').hide();*/


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

function GuardarFormPreclinica(){
  const form =$('#FormularioPleclinica').serialize();


  $.post("index.php?page=cita&op=InPrec&"+form, {
  }, function(response) {
  
   if(response==1){
    showSuccessToast('Ficha Ingresada con Exito');
    $('.form_DatosGenerales').hide('slow');
    $('#FormIncapacidad').show('slow');
    $('.form_DatosGenerales').trigger('reset');
    $('#FormIncapacidad').trigger('reset');
   }else{
    showDangerToast(response);
   }
  
  });

}


$('#FechaNacimiento').on("input", function () { 
  var idinput= this.value;
  
  $.post("index.php?page=cita&op=fecha", {
    idinput:idinput
  }, function(response) {

    $('#txtEdad').val(response.trim());
  
  });
});
function buscarEmpleado() {
var form= $('#FormIncapacidad').serialize();
//alert('hola');
Busqueda(form);
console.log(form);
}

function myfunct(codigo){

  $('.form_DatosGenerales').show('slow');
  $('#FormIncapacidad').hide('slow');

  $.post("index.php?page=cita&op=llenar", {
    codigo:codigo             
})
.done(function(data) {

   
   const json= JSON.parse(data);
    console.log(json['data'][0]['cempno']);

    $('#CodigoEmpleado').val(json['data'][0]['cempno'].trim());
    $('#Nombre').val(json['data'][0]['cfname'].trim());
    $('#Apellido').val(json['data'][0]['clname'].trim());
    $('#txtIdentidad').val(json['data'][0]['cfedid'].trim());
    $('#FechaNacimiento').val(json['data'][0]['fecha'].trim());
    $('#txtOcupacion').val(json['data'][0]['cDesc'].trim());
    $('#Dependencia').val(json['data'][0]['cdeptname'].trim());
    $('#txtSexo').val(json['data'][0]['csex'].trim());
    $('#txtEdad').val(json['data'][0]['edad'].trim());
    
});

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

function Busqueda (form){
"use strict";

var KTDatatablesDataSourceAjaxClient={
init:function(){$("#tabla_ajax1").DataTable(
  {
   
    responsive:!0,
    ajax:{url:"index.php?page=cita&op=mostrar&"+form,
    type:"POST",
    data:{pagination:{perpage:50}}},
    columns:[
    {data:"cempno"},
    {data:"cfname"},
    {data:"clname"},
    {data:"cstatus"},
    {data:"cfedid"},
    {data:"cdeptno"},
    {data:"fecha"},
    {data:"Actions",
    responsivePriority:-1}
    ],
    columnDefs:[
      {targets:-1,
        title:"Actions",
        orderable:!1,
        render:function(data, type, row, meta)
        {
          return'\n                        <span class="dropdown">\n                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\n                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\n                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href="javascript:myfunct(\' '+row['cempno']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class="la la-edit"></i>\n                        </a>'
       }
    },
    {targets:-5,render:function(a,t,e,n)
      {
        var s={
          1:{title:"Activo",class:"kt-badge--success"},
          2:{title:"Inactivo",class:" kt-badge--Info"},
          3:{title:"Cancelado",class:" kt-badge--primary"},
          4:{title:"Success",class:" kt-badge--success"},
          5:{title:"Info",class:" kt-badge--info"},
          6:{title:"Danger",class:" kt-badge--danger"},
          7:{title:"Warning",class:" kt-badge--warning"}};
          return void 0===s[a]?a:'<span class="kt-badge '+s[a].class+' kt-badge--inline kt-badge--pill">'+s[a].title+"</span>"
        }
      },{
        targets:-2,
        render:function(a,t,e,n)
        {var s={1:{
          title:"Online",
          state:"danger"},
          2:{title:"Retail",
          state:"primary"},
          3:{title:"Direct",
          state:"success"}};
          return void 0===s[a]?a:'<span class="kt-badge kt-badge--'+s[a].state+' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-'+s[a].state+'">'+s[a].title+"</span>"
        }
      }
    ]
  }).destroy()}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
}

