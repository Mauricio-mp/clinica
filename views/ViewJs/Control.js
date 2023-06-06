
BusquedaNuevo();

var idPreclinica=0;
var doctor=0;
var SignosVitales=0;
var GlobalExpediente=0;
var globalEntecedente=0;
var GlobalEditarExamenFisico=false;
var globalIdExamenFisico=0;



function myfunct(params,nombre) {
  /*const json = JSON.parse(params); */
  GlobalExpediente=params;
  $('.Acordiones').show();
  $('.busqueda').hide();

  LlenarPreclinicas(params);
  Tabla_Antecedentes_Personales(params);
  CargarExamenesFisicos(params);
  CargarExamenesLaboratoriales(params);
}
function DetallePreclinica(Preclinica) {

  idPreclinica=Preclinica;
  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=DetallePreclinica",
    data: {idPreclinica:idPreclinica},
    success: function (response) {
      var json = JSON.parse(response);

      $('#kt_modal_4').modal('show');
      $('#txtPA').val(json[0]['presionarterial']);

      $('#txtFC').val(json[0]['frecuenciacardiaca']);
      $('#txtPulso').val(json[0]['pulso']);
      $('#txtFR').val(json[0]['frecuenciarespiratoria']);
      $('#txttemperatura').val(json[0]['terperaturacorporal']);
      $('#sp02').val(json[0]['saturacionoxigeno']);
      $('#txtGlu').val(json[0]['glucosa']);
      $('#txtPeso').val(json[0]['peso']);
      $('#txtTalla').val(json[0]['talla']);
      $('#txtIMC').val(json[0]['imc']);
      
    }
  });


}
function CargarExamenesLaboratoriales(id){
  "use strict";
  console.log(id);
  var KTDatatablesDataSourceAjaxClient={
  init:function(){$("#Tabla_Examenes_laboratoriales").DataTable(
    {
      destroy:true,
      searching:true,
      responsive:!0,
      pagingType:"full_numbers",
      "order": [[ 0, 'desc' ]],
      ajax:{url:"index.php?page=Control&op=llenarexamenesLaboratoriales",
      type:"POST",
      data:{pagination:{perpage:50},id:id}},
      columns:[
        {data:"id_laboratorial"},
        {data:"hemograma"},
        {data:"quimica_general"},
        {data:"ego"},
        {data:"egh"},
        {data:"covid"},
        {data:"otros"},
        {data:"fechacreacion"},
        {data:"Accion",
        responsivePriority:-1},
  
      
      ],
      
      columnDefs:[
        
        {
          targets: 0,
          visible: false,
          searchable: false,
      },

        {targets:-1,
          title:"Actions",
          orderable:!1,
          render:function(data, type, row, meta)
          {
            
            return'\n                        <span class="dropdown">\n                            <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="javascript:EditarExamenLab(\' '+row['id_laboratorial']+' \')"><i class="la la-edit"></i> Editar</a>\n                                <a class="dropdown-item" href="javascript:anularExamenLab(\' '+row['id_laboratorial']+' \')"><i class="la la-remove"></i> Anular</a>\n </div>\n                        </span>\n '
          }
      },
      { targets: -2, 
        render: function (t, a, e, n) 
        { 
            var s = { 
                 1: { title: "Sin Asignar", state: "primary" },
                 2: { title: "Sin Aceptar", state: "success" }, 
                 3: { title: "Recibido", state: "secondary" } }; 
                // return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" 
                return void 0 === s[t] ? t : '<span  class="badge badge-' + s[t].state + ' mb-1">' + s[t].title + ' </span >' 
                }
               }
      
      ]
    })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
}
function CargarExamenesFisicos(id){
 
  "use strict";
  var KTDatatablesDataSourceAjaxClient={
  init:function(){$("#Tabla_Examen_Fisico").DataTable(
    {
      destroy:true,
      searching:true,
      responsive:!0,
      pagingType:"full_numbers",
      "order": [[ 0, 'desc' ]],
      ajax:{url:"index.php?page=Control&op=llenarexamenesFisicos",
      type:"POST",
      data:{pagination:{perpage:50},id:id}},
      columns:[
        {data:"id_examen"},
        {data:"aparienciageneral"},
        {data:"fechacreacion"},
        {data:"Accion",
        responsivePriority:-1},
  
      
      ],
      
      columnDefs:[
        
        {
          targets: 0,
          visible: false,
          searchable: false,
      },

        {targets:-1,
          title:"Actions",
          orderable:!1,
          render:function(data, type, row, meta)
          {
            
            return'\n                        <span class="dropdown">\n                            <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="javascript:EditarExamenFisico(\' '+row['id_examen']+' \')"><i class="la la-edit"></i> Editar</a>\n                                <a class="dropdown-item" href="javascript:anularExamenFisico(\' '+row['id_examen']+' \')"><i class="la la-leaf"></i> Anular</a>\n <a class="dropdown-item" href="javascript:DetalleExamenFisico(\' '+row['id_examen']+' \')"><i class="la la-eye"></i> Detalle</a>\n</div>\n                        </span>\n '
          }
      },
      { targets: -2, 
        render: function (t, a, e, n) 
        { 
            var s = { 
                 1: { title: "Sin Asignar", state: "primary" },
                 2: { title: "Sin Aceptar", state: "success" }, 
                 3: { title: "Recibido", state: "secondary" } }; 
                // return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" 
                return void 0 === s[t] ? t : '<span  class="badge badge-' + s[t].state + ' mb-1">' + s[t].title + ' </span >' 
                }
               }
      
      ]
    })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
}

function LlenarPreclinicas(params){
  "use strict";
  var KTDatatablesDataSourceAjaxClient={
  init:function(){$("#Tabla_Preclinica").DataTable(
    {
      destroy:true,
      searching:true,
      responsive:!0,
      pagingType:"full_numbers",
      "order": [[ 0, 'desc' ]],
      ajax:{url:"index.php?page=Control&op=llenarPreclinica",
      type:"POST",
      data:{pagination:{perpage:50},id:params}},
      columns:[
        {data:"pid_signos"},
        {data:"pnombre"},
        {data:"papellido"},
        {data:"fechacreacion"},
        {data:"motivo"},
        {data:"observacion"},
        {data:"Accion",
        responsivePriority:-1},
  
      
      ],
      
      columnDefs:[
        {
          targets: 0,
          visible: false,
          searchable: false,
      },

        {targets:-1,
          title:"Actions",
          orderable:!1,
          render:function(data, type, row, meta)
          {
            
            return'\n                        <span class="dropdown">\n                         \n           \n                        </span>\n                        <a href="javascript:DetallePreclinica(\' '+row['pid_signos']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class=""></i>\n             Detalle          </a>'
         }
      },
      { targets: -2, 
        render: function (t, a, e, n) 
        { 
            var s = { 
                 1: { title: "Sin Asignar", state: "primary" },
                 2: { title: "Sin Aceptar", state: "success" }, 
                 3: { title: "Recibido", state: "secondary" } }; 
                // return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" 
                return void 0 === s[t] ? t : '<span  class="badge badge-' + s[t].state + ' mb-1">' + s[t].title + ' </span >' 
                }
               }
      
      ]
    })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
}
function BusquedaNuevo (){
    "use strict";
    var KTDatatablesDataSourceAjaxClient={
    init:function(){$("#Tabla_Recibir").DataTable(
      {
        destroy:true,
        responsive:!0,
        pagingType:"full_numbers",
        "order": [[ 0, 'desc' ]],
        ajax:{url:"index.php?page=Control&op=llenar",
        type:"POST",
        data:{pagination:{perpage:50}}},
        columns:[
        {data:"id_expediente"},
        {data:"nombre"},
        {data:"fechacreacion"},
        
        {data:"Actions",
        responsivePriority:-1},
        
        ],
        
        columnDefs:[
          {targets:-1,
            title:"Actions",
            orderable:!1,
            render:function(data, type, row, meta)
            {
              
              return'\n                        <span class="dropdown">\n                         \n           \n                        </span>\n                        <a href="javascript:myfunct(\' '+row['id_expediente']+' \',\' '+row['nombre']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class=""></i>\n             Gestionar          </a>'
           }
        },
        { targets: -2, 
          render: function (t, a, e, n) 
          { 
              var s = { 
                   1: { title: "Sin Asignar", state: "primary" },
                   2: { title: "Sin Aceptar", state: "success" }, 
                   3: { title: "Recibido", state: "secondary" } }; 
                  // return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" 
                  return void 0 === s[t] ? t : '<span  class="badge badge-' + s[t].state + ' mb-1">' + s[t].title + ' </span >' 
                  }
                 }
        
        ]
      })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
    }

    function llenarCombo(){
      $('#cbxDocotres').empty();
      $.post("index.php?page=Registro&op=doctores", {
                    
    })
    .done(function(data) {
       const json=JSON.parse(data);
       
       doctor=json;
       console.log(doctor);
      for (var index = 0; index <= json['data'].length; index++) {
        $('#cbxDocotres').append($('<option>').val(json['data'][index]['id_usuario']).text(json['data'][index]['nombrecompleto']));
        
      }



       
    
    });
    }

    $('#BtnRecibirCita').click(function (e) { 
      e.preventDefault();

   
 

$.post("index.php?page=recibir&op=GuardarExpediente", {
  SignosVitales:SignosVitales
    })
    .done(function(data) {

       
       BusquedaNuevo();
       $('#kt_modal_4').modal('hide');
    });


   
    });

    function agregar(){
      $('#accordionExample4').hide();
      $('.Antecedentes_Personales').show();
      $('#msgBotonAntecedente').show();
      $('#msgBotonAntecedente').text('Aceptar');
      $('#msgBotonARegresarAncedente').text('Cancelar');
      $("#From_Antecedentes_Personales")[0].reset();
      $('#From_Antecedentes_Personales').attr('name', '');
    }


    function GuardarFormAntecedentesPersonales(Editar,name){
      switch (Editar) {
        case false:
          var formulario = $("#From_Antecedentes_Personales").serialize();
      $.ajax({
        type: "POST",
        url: "index.php?page=Control&op=guardarANtecedente&"+formulario,
        data: {idExpediente:GlobalExpediente},
        success: function (response) {
          if (response==true) {
            showSuccessToast(response);
            $('.Acordiones').show();
            $('#accordionExample4').show();
            $('.Antecedentes_Personales').hide();
            Tabla_Antecedentes_Personales(GlobalExpediente);
          }
          
         // showDangerToast(response);
        }
      });
          break;
      case true:
        var formulario = $("#From_Antecedentes_Personales").serialize();
      $.ajax({
        type: "POST",
        url: "index.php?page=Control&op=EditarANtecedente&"+formulario,
        data: {id:name},
        success: function (response) {

      
          if (response==true) {


            
            showSuccessToast(response);
            $('.Acordiones').show();
            $('#accordionExample4').show();
            $('.Antecedentes_Personales').hide();
            Tabla_Antecedentes_Personales(GlobalExpediente);

            
          }else{
            showDangerToast(response);
          }
          
        
        }
      });
      break;
        default:
          break;
      }
      
    }

    function ReturnDiv(){
      
      $('.Acordiones').show();
      $('#accordionExample4').show();
      $('.Antecedentes_Personales').hide();
      $("#From_Antecedentes_Personales")[0].reset();
      
    }

    function ReturnDivFisicos(){
      $('.Acordiones').show();
      $('#accordionExample4').show();
      $('.Examenes_Fisicos').hide();
      $('.Examenes_Laboratoriales').hide();
      $("#form_Examenes_Fisicos")[0].reset();
      $("#form_Examenes_Laboratoriales")[0].reset();
      $('#msgBotonExamenFisico').show();
      $('.botoncancelarAction').text('Cancelar');
      $('#msgBotonExamenFisico').text('Aceptar');
    }

    function DetalleAntecedente(id) {
     
      $.ajax({
        type: "POST",
        url: "index.php?page=Control&op=MostrarDatosActualizar",
        data: {id:id},
        success: function (response) {
          $('#msgBotonARegresarAncedente').text('Regresar');
          $('#msgBotonAntecedente').hide();
          $('.Acordiones').hide();
        $('#accordionExample4').hide();
        $('.Antecedentes_Personales').show();
        $("#From_Antecedentes_Personales")[0].reset();
        $('#From_Antecedentes_Personales').attr('name', id);
        var json= JSON.parse(response);
        $('#txtApp').val(json['data'][0]['app'])
        $('#txtAF').val(json['data'][0]['af'])
        $('#txtAHGT').val(json['data'][0]['ahqt'])
        $('#txtAlergias').val(json['data'][0]['alergias'])
        $('#txtVacunas').val(json['data'][0]['vacunas'])
        $('#txtAE').val(json['data'][0]['ae'])
        $('#txtHabitosToxicos').val(json['data'][0]['habitos_toxicos'])
        $('#habitosnoToxicos').val(json['data'][0]['habitos_no_toxicos'])
        $('#txtHabitosSaludables').val(json['data'][0]['habitos_saludables'])
        $('#AntGo').val(json['data'][0]['antecedentes_go'])
  
  
        }
      });

      }


    

    function Tabla_Antecedentes_Personales (id){
      "use strict";

      var KTDatatablesDataSourceAjaxClient={
      init:function(){$("#Tabla_Antecedentes_Personales").DataTable(
        {
          
          destroy:true,
          searching:true,
          responsive:!0,
          pagingType:"full_numbers",
          order: [[ 0, 'desc' ]],
          ajax:{url:"index.php?page=Control&op=Antecedentes",
          type:"POST",
          data:{pagination:{perpage:50},id:id}},
          columns:[
          {data:"id_antecedente"},
          {data:"app"},
          {data:"af"},
          {data:"ahqt"},
          {data:"alergias"},
          {data:"vacunas"},
          {data:"fecha"},
          {data:"Action",
          responsivePriority:-1},
          
          ],
          
          columnDefs:[
            {
              targets:0,
              visible:false
            },
            {targets:-1,
              title:"Actions",
              orderable:!1,
              render:function(data, type, row, meta)
              {
                
                return'\n                        <span class="dropdown">\n                            <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="javascript:Editar(\' '+row['id_antecedente']+' \')"><i class="la la-edit"></i> Editar</a>\n                                <a class="dropdown-item" href="javascript:anular(\' '+row['id_antecedente']+' \')"><i class="la la-leaf"></i> Anular</a>\n <a class="dropdown-item" href="javascript:DetalleAntecedente(\' '+row['id_antecedente']+' \')"><i class="la la-eye"></i> Detalle</a>\n</div>\n                        </span>\n '
             }
          },
          { targets: -2, 
            render: function (t, a, e, n) 
            { 
                var s = { 
                     1: { title: "Sin Asignar", state: "primary" },
                     2: { title: "Sin Aceptar", state: "success" }, 
                     3: { title: "Recibido", state: "secondary" } }; 
                    // return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" 
                    return void 0 === s[t] ? t : '<span  class="badge badge-' + s[t].state + ' mb-1">' + s[t].title + ' </span >' 
                    }
                   }
          
          ]
        })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
      }
 function EditarExamenLab(id){
  $('.Acordiones').hide();
  $('#accordionExample4').hide();
  $("#form_Examenes_Laboratoriales")[0].reset();
  $(".Examenes_Laboratoriales").show();
  
 }     

function EditarExamenFisico(id){
  GlobalEditarExamenFisico=true;
  globalIdExamenFisico=id;
  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=mostrarExamenfisico",
    data: {id:id},
    success: function (response) {
      var json = JSON.parse(response);
      console.log(json[0]['torax']);

      $('.Acordiones').hide();
      $('#accordionExample4').hide();
      $('.Examenes_Fisicos').show();
      $("#form_Examenes_Fisicos")[0].reset();

      $('#msgBotonExamenFisico').text('Mofificar');
      $('#txtPariencia').val(json[0]['aparienciageneral']);
      $('#txtCabeza').val(json[0]['cabeza']);
      $('#txtCuello').val(json[0]['cuello']);
      $('#txtCorazon').val(json[0]['corazon']);
      $('#txtPulmones').val(json[0]['pulmones']);
      $('#txtmamas').val(json[0]['mamas']);
      $('#txtabdomen').val(json[0]['abdomen']);
      $('#txtGenilates').val(json[0]['genitales']);
      $('#txtOsteomuscular').val(json[0]['osteomuscular']);
      $('#txtExtremidades').val(json[0]['piel']);
      $('#txtPielFaneas').val(json[0]['piel']);
      $('#txtNeurologico').val(json[0]['neurologicos']);
      $('#txtTorax').val(json[0]['torax']);


    }
  });
}
function Editar(id) {
    

    $.ajax({
      type: "POST",
      url: "index.php?page=Control&op=MostrarDatosActualizar",
      data: {id:id},
      success: function (response) {
        $('#msgBotonAntecedente').show();
        $('#msgBotonAntecedente').text('Modificar');
        $('#msgBotonARegresarAncedente').text('Cancelar');
        $('.Acordiones').hide();
      $('#accordionExample4').hide();
      $('.Antecedentes_Personales').show();
      $("#From_Antecedentes_Personales")[0].reset();
      $('#From_Antecedentes_Personales').attr('name', id);
      var json= JSON.parse(response);
      $('#txtApp').val(json['data'][0]['app'])
      $('#txtAF').val(json['data'][0]['af'])
      $('#txtAHGT').val(json['data'][0]['ahqt'])
      $('#txtAlergias').val(json['data'][0]['alergias'])
      $('#txtVacunas').val(json['data'][0]['vacunas'])
      $('#txtAE').val(json['data'][0]['ae'])
      $('#txtHabitosToxicos').val(json['data'][0]['habitos_toxicos'])
      $('#habitosnoToxicos').val(json['data'][0]['habitos_no_toxicos'])
      $('#txtHabitosSaludables').val(json['data'][0]['habitos_saludables'])
      $('#AntGo').val(json['data'][0]['antecedentes_go'])


      }
    });
  }      

  function anular(id){
    globalEntecedente=id;
    $('#labelAnular').text('¿Anular Antecedente?');
    $('#demoModal').modal('show');
  }

  $('#BtnAnular').click(function () {
    

    $.ajax({
      type: "POST",
      url: "index.php?page=Control&op=AnularAncedente",
      data: {idAntecedente:globalEntecedente},
      success: function (response) {
        if (response==true) {
          $('#demoModal').modal('hide');
          Tabla_Antecedentes_Personales(GlobalExpediente);
          showSuccessToast('Ingresado conexito');
        }else{
          showDangerToast(response);
        }
      }
    });
    
    })


function agregarExamenFisico(){
  $('.Acordiones').hide();
  $('#accordionExample4').hide();
  $('.Examenes_Fisicos').show();
  GlobalEditarExamenFisico=false;
}

function GuardarExamenFisico(){

switch (GlobalEditarExamenFisico) {
  case true:
  
 var form = $('#form_Examenes_Fisicos').serialize();
  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=UpdateExamenFisico&"+form,
    data: {id:globalIdExamenFisico},
    success: function (response) {
      if (response==true) {

       
        $('.Acordiones').show();
        $('#accordionExample4').show();
        $('.Examenes_Fisicos').hide();
        showSuccessToast('Ingresado con exito');
        CargarExamenesFisicos(GlobalExpediente);
        
      }else{
        
        showDangerToast(response);
       
      }
    }
  });

  
    break;
  case false:
    
 var form = $('#form_Examenes_Fisicos').serialize();
  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=guardarFisicos&"+form,
    data: {expediente:GlobalExpediente},
    success: function (response) {
      if (response==true) {
       
        $('.Acordiones').show();
        $('#accordionExample4').show();
        $('.Examenes_Fisicos').hide();
        showSuccessToast('Ingresado con exito');
        CargarExamenesFisicos(GlobalExpediente);
      }else{
        
        showDangerToast(response);
       
      }
    }
  });

  
    break;
  default:
    break;
}


}
function anularExamenLab(id){
 
  bootbox.confirm({
      
    closeButton: false,
    locale:'es',
    message:'<p>¿Eliminar Examen de laboratorio?</p>',
    title:'<h3>Anular Examen</h3>',
    callback:function(result){
      if (result) {
        $.ajax({
          type: "POST",
          url: "index.php?page=Control&op=anularlab",
          data:{id:id},
          success: function (response) {
            if (response==true) {
              showSuccessToast('anulado con exito');
              CargarExamenesLaboratoriales(GlobalExpediente);
            }else{
              showDangerToast(response);
            }
          }
        });
      }
    }
  })
}

function anularExamenFisico(idexamen){
 
  bootbox.confirm({
      
      closeButton: false,
      locale:'es',
      message:'<p>¿Eliminar Examen Fisico?</p>',
      title:'<h3>Anular Examen Fisico</h3>',
      callback:function(result){
        if (result) {
          $.ajax({
            type: "POST",
            url: "index.php?page=Control&op=aliminarexamenFisico",
            data: {idexamen:idexamen},
            success: function (response) {

              if (response==true) {
                CargarExamenesFisicos(GlobalExpediente);
                showSuccessToast('Anulado Con exito con exito');

              }else{
                showDangerToast(response);
              }
            }
          });
        }
      }
    })
    
}
function DetalleExamenFisico(id){

  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=mostrarExamenfisico",
    data: {id:id},
    success: function (response) {
      $('#msgBotonExamenFisico').hide();
      $('.Acordiones').hide();
      $('#accordionExample4').hide();
      $('.Examenes_Fisicos').show();
      $('.botoncancelarAction').text('Regresar');
      var json = JSON.parse(response);
      console.log(json[0]['torax']);
      $("#form_Examenes_Fisicos")[0].reset();
      $('#txtPariencia').val(json[0]['aparienciageneral']);
      $('#txtCabeza').val(json[0]['cabeza']);
      $('#txtCuello').val(json[0]['cuello']);
      $('#txtCorazon').val(json[0]['corazon']);
      $('#txtPulmones').val(json[0]['pulmones']);
      $('#txtmamas').val(json[0]['mamas']);
      $('#txtabdomen').val(json[0]['abdomen']);
      $('#txtGenilates').val(json[0]['genitales']);
      $('#txtOsteomuscular').val(json[0]['osteomuscular']);
      $('#txtExtremidades').val(json[0]['piel']);
      $('#txtPielFaneas').val(json[0]['piel']);
      $('#txtNeurologico').val(json[0]['neurologicos']);
      $('#txtTorax').val(json[0]['torax']);


    }
  });
}

function agregarExamenLab(){
  $('.Acordiones').hide();
  $('#accordionExample4').hide();
  $('.Examenes_Laboratoriales').show();
}

$('#BtnAceptarLaboratoriales').click(function() {
  var form = $('#form_Examenes_Laboratoriales').serialize();
  $.ajax({
    type: "POST",
    url: "index.php?page=Control&op=GuardarLaboratorios&"+form,
    data: {GlobalExpediente:GlobalExpediente},
    success: function (response) {
      if (response==true) {
        showSuccessToast('Ingresado con exito');
        ReturnDivFisicos();
        CargarExamenesLaboratoriales(GlobalExpediente);
        
      }else{
        showDangerToast(response);
      }
    }
  });
});





