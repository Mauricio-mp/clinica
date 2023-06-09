var KTBootstrapDaterangepicker={init:function(){!function(){
    $("#kt_daterangepicker_1, #kt_daterangepicker_1_modal").daterangepicker(
        {
            language:'es',
            buttonClasses:" btn",
            applyClass:"btn-primary",
            cancelClass:"btn-secondary"}),
            $("#kt_daterangepicker_2").daterangepicker(
                {
                    buttonClasses:" btn",
                    applyClass:"btn-primary",
                    cancelClass:"btn-secondary"},
                    function(a,t,e){
                        $("#kt_daterangepicker_2 .form-control").val(a.format("DD/MM/YYYY")+" - "+t.format("DD/MM/YYYY"))}),
                        $("#kt_daterangepicker_2_modal").daterangepicker(
                            {
                                buttonClasses:" btn",
                                applyClass:"btn-primary",
                                cancelClass:"btn-secondary"
                            },function(a,t,e){
                                $("#kt_daterangepicker_2 .form-control").val(a.format("DD/MM/YYYY")+" / "+t.format("DD/MM/YYYY"))}),
                                $("#kt_daterangepicker_3").daterangepicker(
                                    {
                                        buttonClasses:" btn",
                                        applyClass:"btn-primary",
                                        cancelClass:"btn-secondary"},
                                        function(a,t,e){$("#kt_daterangepicker_3 .form-control").val(a.format("YYYY-MM-DD")+" / "+t.format("YYYY-MM-DD"))}),
                                        $("#kt_daterangepicker_3_modal").daterangepicker(
                                            {
                                                buttonClasses:" btn",applyClass:"btn-primary",cancelClass:"btn-secondary"},function(a,t,e){
                                                    $("#kt_daterangepicker_3 .form-control").val(a.format("YYYY-MM-DD")+" / "+t.format("YYYY-MM-DD"))}),
                                                    $("#kt_daterangepicker_4").daterangepicker(
                                                        {
                                                            buttonClasses:" btn",
                                                            applyClass:"btn-primary",
                                                            cancelClass:"btn-secondary",
                                                            timePicker:!0,
                                                            timePickerIncrement:30,
                                                            locale:{format:"MM/DD/YYYY h:mm A"}},function(a,t,e){
                                                                $("#kt_daterangepicker_4 .form-control").val(a.format("MM/DD/YYYY h:mm A")+" / "+t.format("MM/DD/YYYY h:mm A"))}),
                                                                $("#kt_daterangepicker_5").daterangepicker(
                                                                    {
                                                                        buttonClasses:" btn",
                                                                        applyClass:"btn-primary",
                                                                        cancelClass:"btn-secondary",
                                                                        singleDatePicker:!0,
                                                                        showDropdowns:!0,
                                                                        locale:{format:"MM/DD/YYYY"}},
                                                                        function(a,t,e){
                                                                            $("#kt_daterangepicker_5 .form-control").val(a.format("MM/DD/YYYY")+" / "+t.format("MM/DD/YYYY"))});
                                                                            var a=moment().subtract(29,"days"),t=moment();
                                                                            $("#kt_daterangepicker_6").daterangepicker(
                                                                                {
                                                                                    buttonClasses:" btn",
                                                                                    applyClass:"btn-primary",
                                                                                    cancelClass:"btn-secondary",
                                                                                    startDate:a,endDate:t,ranges:{Today:[moment(),moment()],
                                                                                        Yesterday:[moment().subtract(1,"days"),moment().subtract(1,"days")],
                                                                                        "Last 7 Days":[moment().subtract(6,"days"),moment()],
                                                                                        "Last 30 Days":[moment().subtract(29,"days"),moment()],
                                                                                        "This Month":[moment().startOf("month"),moment().endOf("month")],
                                                                                        "Last Month":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}},
                                                                                        function(a,t,e){$("#kt_daterangepicker_6 .form-control").val(a.format("MM/DD/YYYY")+" / "+t.format("MM/DD/YYYY"))})}(),
                                                                                    $("#kt_daterangepicker_1_validate").daterangepicker(
                                                                                        {
                                                                                            buttonClasses:" btn",
                                                                                            applyClass:"btn-primary",
                                                                                            cancelClass:"btn-secondary"},
                                                                                    function(a,t,e){$("#kt_daterangepicker_1_validate .form-control").val(a.format("YYYY-MM-DD")+" / "+t.format("YYYY-MM-DD"))}),
                                                                                    $("#kt_daterangepicker_2_validate").daterangepicker(
                                                                                        {
                                                                                            buttonClasses:" btn",
                                                                                            applyClass:"btn-primary",
                                                                                            cancelClass:"btn-secondary"},
                                                                                            function(a,t,e){$("#kt_daterangepicker_3_validate .form-control").val(a.format("YYYY-MM-DD")+" / "+t.format("YYYY-MM-DD"))}),
                                                                                            $("#kt_daterangepicker_3_validate").daterangepicker(
                                                                                                {
                                                                                                    buttonClasses:" btn",
                                                                                                    applyClass:"btn-primary",
                                                                                                    cancelClass:"btn-secondary"},
                                                                                                    function(a,t,e)
                                                                                                    {
                                                                                                        $("#kt_daterangepicker_3_validate .form-control").val(a.format("YYYY-MM-DD")+" / "+t.format("YYYY-MM-DD"))})}};jQuery(document).ready(function(){KTBootstrapDaterangepicker.init()});