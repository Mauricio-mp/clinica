
Busqueda();
function Busqueda (){
    "use strict";
    
    var KTDatatablesDataSourceAjaxClient={
    init:function(){$("#tabla_registro").DataTable(
      {
        responsive:!0,
        pagingType:"full_numbers",
        select: true,
        dom: 'Bfrtip',
            
              "createdRow": function (row, data, index) {
                $(row).addClass('active');
              
              },
             
            buttons: [
             
            'print',
            
            
             {
                    extend: "selectedSingle",
                    title:"accion",
                    text: 'Generar Archivo',
                    fieldSeparator: "\t",
                    action: function () {
                     /*   s.rows().select(); */
                        var rowData = lista.rows( { selected: true } ).data()[0];
                        
                     
                        Archivo(rowData[0]);
                    }
                },
                {
                    extend: "selectedSingle",
                    title:"accion",
                    text: 'Consolidado',
                    fieldSeparator: "\t",
                    action: function () {
                     /*   s.rows().select(); */
                        var rowData = lista.rows( { selected: true } ).data()[0];
                        
                     
                        Imprmir(rowData[0]);
                    }
                },
                {
                    extend: "selectedSingle",
                    title:"accion",
                    text: 'Anular',
                    fieldSeparator: "\t",
                    action: function () {
                     /*   s.rows().select(); */
                        var rowData = lista.rows( { selected: true } ).data()[0];
                        
                 
                        Anular(rowData[0],rowData[1]);
                    }
                },,
                {
                   
                    text: 'Quitar Seleccion',
                    action: function () {
                        lista.rows().deselect();
                        
                    }
                }],
       
        order:[[6,"desc"]],

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
      })}};jQuery(document).ready(function(){KTDatatablesDataSourceAjaxClient.init()});
    }