"use strict";
var KTDatatablesDataSourceHtml = {
    init: function () {
        $("#pruebas_tabla").DataTable(
            {
                destroy: true,
                paging: true,
                searching: true,
                responsive: !0,
                columnDefs:
                    [{  targets: -1, 
                        title: "Total", 
                        orderable: !1, 
                        render: function (t, a, e, n) { 
                            return  e[4] } },
                              { "visible": true,  "targets": [ 2 ] },
                             {
                                  targets: 3,
                                 render: function (t, a, e, n) { 
                                     var s = { 
                                         1: { title: "Activo", class: " kt-badge--success" }, 
                                         0: { title: "Inactivo", class: " kt-badge--danger" }}; 
                                         return void 0 === s[t] ? t : '<span class="kt-badge ' + s[t].class + ' kt-badge--inline kt-badge--pill">' + s[t].title + "</span>" } },
                                          { targets: 4, render: function (t, a, e, n) 
                                            { 
                                                var s = { 
                                                     1: { title: "Online", state: "danger" },
                                                     2: { title: "Retail", state: "primary" }, 
                                                     3: { title: "Direct", state: "success" } }; 
                                                     return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" } }]
            }),
            $("#table").DataTable(
            {
                destroy: true,
                paging: true,
                searching: true,
                responsive: !0,
                columnDefs:
                    [{ targets: -1, 
                        title: "Actions", 
                        orderable: !1, 
                        render: function (t, a, e, n) { 
                            return '\n                        <span class="dropdown">\n                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Cambiar Nombre</a>\n                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Cambiar Estado</a>\n                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">\n                          <i class="la la-edit"></i>\n                        </a>' } },
                             {
                                  targets: 1,
                                 render: function (t, a, e, n) { 
                                     var s = { 
                                         1: { title: "Pending", class: "kt-badge--brand" }, 
                                         2: { title: "Delivered", class: " kt-badge--danger" }, 
                                         3: { title: "Canceled", class: " kt-badge--primary" }, 
                                         4: { title: "Success", class: " kt-badge--success" }, 
                                         5: { title: "Info", class: " kt-badge--info" }, 
                                         6: { title: "Danger", class: " kt-badge--danger" }, 
                                         7: { title: "Warning", class: " kt-badge--warning" } }; 
                                         return void 0 === s[t] ? t : '<span class="kt-badge ' + s[t].class + ' kt-badge--inline kt-badge--pill">' + s[t].title + "</span>" } },
                                          { targets: 2, render: function (t, a, e, n) 
                                            { 
                                                var s = { 
                                                     1: { title: "Online", state: "danger" },
                                                     2: { title: "Retail", state: "primary" }, 
                                                     3: { title: "Direct", state: "success" } }; 
                                                     return void 0 === s[t] ? t : '<span class="kt-badge kt-badge--' + s[t].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + s[t].state + '">' + s[t].title + "</span>" } }]
            })
    }
}; jQuery(document).ready(function () { KTDatatablesDataSourceHtml.init() });
