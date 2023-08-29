
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
function DetallePreclinica(id){
  $.ajax({
    type: "POST",
    url: "index.php?page=Registro&op=mostrarDetalle",
    data: {id:id},
    success: function (response) {
      $('#Detale').modal('show');
      var json= JSON.parse(response);
      $('#PA').val(json[0]['presionarterial']);
      $('#FC').val(json[0]['frecuenciacardiaca']);
      $('#pulso').val(json[0]['pulso']);
      $('#FR').val(json[0]['frecuenciarespiratoria']);
      $('#temparatura').val(json[0]['terperaturacorporal']);
      $('#Sp02').val(json[0]['saturacionoxigeno']);
      $('#Glu').val(json[0]['glucosa']);
      $('#peso').val(json[0]['peso']);
      $('#talla').val(json[0]['talla']);
      $('#imc').val(json[0]['imc']);
      console.log(json[0]);
    }
  });
 
}
function BorarPreclinica(id){
  
  bootbox.confirm({
      
    closeButton: false,
    locale:'es',
    message:'<p>¿Anular Ficha?</p>',
    title:'<h3>Esta seguro de eliminar esta ficha</h3>',
    callback:function(result){
      if (result) {
        $.ajax({
          type: "POST",
          url: "index.php?page=Registro&op=AnularSignos",
          data: {id:id},
          success: function (response) {
            if (response==true) {
              showSuccessToast('Ficha Anulada con Exito');
              BusquedaNuevo();
            }else{
              showDangerToast(response);
            }
          }
        });
        
      }
    }
  })

}

function BusquedaNuevo (){
    "use strict";
   
    var KTDatatablesDataSourceAjaxClient={
    init:function(){$("#tabla_registro").DataTable(
      {
        destroy:true,
        responsive:!0,
        pagingType:"full_numbers",
        "order": [[ 7, 'desc' ]],
       
        ajax:{url:"index.php?page=Registro&op=llenar",
       
        type:"POST",
        data:{pagination:{perpage:50}}},
        columns:[
        {data:"pidenticacion"},
        {data:"pcodigo"},
        {data:"pnombre"},
        {data:"papellido"},
        {data:"motivo"},
        {data:"atencion"},
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
              var anular='';
              var enviar='';
              var finalizar='';
              if (row['estado']==1) {
                anular ='<a href="javascript:BorarPreclinica(\' '+row['pid']+' \')"><i class="ik ik-trash-2">Anular</i></a> ';
                enviar ='<a href="javascript:myfunct(\' '+row['pid']+' \')"><i class="ik ik-navigation">Enviar</i></a>';
              }
              if (row['estado']==3) {
               finalizar ='<a href="javascript:FinalizarPrelcinica(\' '+row['estado']+' \',\' '+row['pid']+' \')"><i class="ik ik-power">Finalizar</i></a> ';
              }
              return ' <div class="table-actions">         '+enviar+'   '+anular+' <a href="javascript:DetallePreclinica(\' '+row['pid']+' \')"><i class="ik ik-eye">Detalle</i></a> '+finalizar+'         </div> '
           }
        },
        { targets: -2, 
          render: function (t, a, e, n) 
          { 
              var s = { 
                   1: { title: "Sin Asignar", state: "primary" },
                   2: { title: "Enviado", state: "success" }, 
                   3: { title: "Recibido", state: "secondary" }, 
                   4: { title: "finalizado", state: "badge-pill badge-danger mb-1" } }; 
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
    function FinalizarPrelcinica(estado,id){
      $.ajax({
        type: "POST",
        url: "index.php?page=Registro&op=finalizarcita",
        data: {estado:estado,id:id},
        success: function (response) {
          if(response==true){
            BusquedaNuevo();
          }else{
            BusquedaNuevo();
          }
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