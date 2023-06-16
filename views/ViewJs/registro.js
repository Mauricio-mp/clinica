
//Busqueda();
BusquedaNuevo();
var idPreclinica=0;
var doctor=0;
function myfunct(params) {
  /*const json = JSON.parse(params); */
  idPreclinica=params;
  llenarCombo();
  $('#kt_modal_4').modal('show');
}
function BusquedaNuevo (){
    "use strict";
    var KTDatatablesDataSourceAjaxClient={
    init:function(){$("#tabla_registro").DataTable(
      {
        destroy:true,
        responsive:!0,
        pagingType:"full_numbers",
        "order": [[ 6, 'desc' ]],
       
        ajax:{url:"index.php?page=Registro&op=llenar",
       
        type:"POST",
        data:{pagination:{perpage:50}}},
        columns:[
        {data:"pidenticacion"},
        {data:"pcodigo"},
        {data:"pnombre"},
        {data:"papellido"},
        {data:"motivo"},
        {data:"observacion"},
        {data:"fechacreacion"},
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
              
              return'\n                        <span class="dropdown">\n                         \n           \n                        </span>\n                        <a href="javascript:myfunct(\' '+row['pid']+' \')" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class="la la-paper-plane-o"></i>\n             Enviar          </a>'
           }
        },
        { targets: -2, 
          render: function (t, a, e, n) 
          { 
              var s = { 
                   1: { title: "Sin Asignar", state: "primary" },
                   2: { title: "Enviado", state: "success" }, 
                   3: { title: "Error", state: "secondary" } }; 
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

    $('#BtoEnnviarPreclinica').click(function (e) { 
      e.preventDefault();
      var idCombo=$('#cbxDocotres').val();
     

$.post("index.php?page=Registro&op=EnviaraTraslado", {
  idPreclinica: idPreclinica,
  id:idCombo   
    })
    .done(function(data) {

       if (data==1) {
        $('#kt_modal_4').modal('hide');
        BusquedaNuevo();
       }
    });

    });