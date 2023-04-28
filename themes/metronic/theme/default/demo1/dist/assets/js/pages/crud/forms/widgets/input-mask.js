var KTInputmask={init:function()
    {$("#kt_inputmask_1").inputmask("99/99/9999",{placeholder:"mm/dd/yyyy",autoUnmask:!0}),
    $("#kt_inputmask_2").inputmask("99/99/9999",{placeholder:"mm/dd/yyyy"}),
    $("#kt_inputmask_3").inputmask("mask",{mask:"9999-9999-99999"}),
    $("#idenficacionCita").inputmask("mask",{mask:"9999-9999-99999"}),
    $("#kt_inputmask_4").inputmask({mask:"99-9999999",placeholder:""}),
    $("#kt_inputmask_5").inputmask({mask:"9",repeat:10,greedy:!1}),
    $("#kt_inputmask_6").inputmask("decimal",{rightAlignNumerics:!1}),
    $("#kt_inputmask_7").inputmask("€ 999.999.999,99",{numericInput:!0}),
    $("#kt_inputmask_8").inputmask({mask:"999.999.999.999"}),
    $("#kt_inputmask_9").inputmask({mask:"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",greedy:!1,onBeforePaste:function(t,a)
    {
        return(t=t.toLowerCase()).replace("mailto:","")},
        definitions:{"*":{validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
        cardinality:1,casing:"lower"}}})}};jQuery(document).ready(function(){KTInputmask.init()});

        