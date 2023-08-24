

$( document ).ready(function() {
    llenarCombo();
    /*$('.form_DatosGenerales').hide();
    */
  $('#peso').on("input", function () { 
    var peso= this.value;
    const talla = $('#talla').val();
  const imc= peso /Math.pow(talla, 2); 
    $('#imc').val(imc.toFixed(2));
  });
  $('#talla').on("input", function () { 
    var talla= this.value;
    const peso = $('#peso').val();
    const imc= peso /Math.pow(talla, 2); 
    $('#imc').val(imc.toFixed(2));
   
  });
    $.post("index.php?page=cita&op=empleado", {
    }, function(response) {
    
      var json=JSON.parse(response);
      
      for (let i = 0; i < json.length; i++) {
        const element = json[i]['cempno'];
        const nombre = json[i]['cfname']+' '+json[i]['clname'];
        $('#cbxCita').append($('<option>').val(element).text(nombre));
      }
    
    });
  });
 
  function llenarCombo() {
    $.ajax({
        type: "POST",
        url: "index.php?page=cita&op=mostrarTipoAtencion",
        data: "data",
        success: function (response) {
          var json=  JSON.parse(response);
            for (let index = 0; index < json.length; index++) {
              $('#CbxTipoAtencion').append($('<option>').val(json[index]['cid']).text(json[index]['cnombre']));
              
            }
            
          
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

  function GuardarFormEmpleado(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var text=$('#labelIdpersona').text();


    var form=$('#FormEmpleadoExiste').serialize();
    $.ajax({
      type: "POST",
      url: "index.php?page=EmpleadoExistente&op=InPrec&id="+text,
      data:form,
      success: function (response) {
        if (response==true) {
          showSuccessToast('Ficha Ingresada con Exito');
          setTimeout(saludos, 4000);
       

        }else{
          showDangerToast(response);
        }
      }
    });

  }
  function saludos(){
  window.location.href='index.php?page=cita';
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
            return'\n                        <span class="dropdown">\n                                                                            </span>\n                        <a href="javascript:myfunct(\' '+row['cempno']+' \',\' '+row['cfedid']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class="la la-edit"></i>\n                        </a>'
         }
      },
      {targets:-5,render:function(a,t,e,n)
        {
          var s={
            1:{title:"Activo",class:"kt-badge--success"},
            2:{title:"Inactivo",class:" kt-badge--warning"},
            3:{title:"Cancelado",class:" kt-badge--danger"},
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
  
  