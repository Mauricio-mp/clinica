
BusquedaNuevo();
var idPreclinica=0;
var doctor=0;
var SignosVitales=0;

function myfunct(params,nombre) {
  /*const json = JSON.parse(params); */
 
  $('.Acordiones').show();
  $('.busqueda').hide();

  LlenarPreclinicas(params)
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
      console.log(json[0]['presionarterial']);
    }
  });


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