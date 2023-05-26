
BusquedaNuevo();
var idPreclinica=0;
var doctor=0;
var SignosVitales=0;
var GlobalIdentidad=0;
function myfunct(params,pidenticacion) {
  /*const json = JSON.parse(params); */
  SignosVitales=params;
  GlobalIdentidad=pidenticacion;
  llenarCombo();
  $('#kt_modal_4').modal('show');


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
        ajax:{url:"index.php?page=recibir&op=llenar",
        type:"POST",
        data:{pagination:{perpage:50}}},
        columns:[
        {data:"pid"},
        {data:"pidenticacion"},
        {data:"pnombre"},
        {data:"papellido"},
        {data:"motivo"},
        {data:"observacion"},
        {data:"fecha_traslado"},
        {data:"hora"},
        {data:"estado"},
        {data:"Actions",
        responsivePriority:-1},
        
        ],
        
        columnDefs:[
          {targets:-1,
            title:"Actions",
            orderable:!1,
            render:function(data, type, row, meta)
            {
              
              return'\n                        <span class="dropdown">\n                         \n           \n                        </span>\n                        <a href="javascript:myfunct(\' '+row['pid']+' \',\' '+row['pidenticacion']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class=""></i>\n             Recibir          </a>'
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
  SignosVitales:SignosVitales,
  GlobalIdentidad:GlobalIdentidad
    })
    .done(function(data) {

       
       BusquedaNuevo();
       $('#kt_modal_4').modal('hide');
    });

    });