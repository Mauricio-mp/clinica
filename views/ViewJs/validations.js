var KTFormControls={init:function(){
    $("#FormEmpleadoExiste").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        rules:
        {
            txtIdentidad:{
                required:true,
                minlength:2
            },
            CbxTipoAtencion:{
                required:true,
            },
            motivo:{
                required:true,
                minlength:5
            },
            CodigoEmpleado:{
                required:true,
            },
            Nombre:{
                required:true,
            },
            Apellido:{
                required:true,
            }
            
        },
        messages: {
       
            txtIdentidad: {
              required: "La identidad es requerida",
              minlength:"Ingrese almenos 2 caracteres",
            },
            CbxTipoAtencion:{
                required: "Porfavor Seleccione Tipo de Atencion",
            },
            motivo:{
                required: "Ingrese Motivo de Visita",
                minlength:"minimo 5 caracteres",
            },
            CodigoEmpleado:{
                required:"Codigo de Empleado Requerido",
            },
            Nombre:{
                required:"Nombre es requerido",
            },
            Apellido:{
                required:"Apellido es Requerido",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
           
            GuardarFormEmpleado();
        },success: function(label){
           
            
        }
    }),
    $("#form_Incapacidad").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        
        rules:
        {
            FechaInicio:{
                required:true
              
            },
            FechaFinIncapacidad:{
                required:true
            
            }
        },
        messages: {
       
            FechaInicio: {
              required: "Llenar fecha de inicio",
            },
            FechaFinIncapacidad: {
                required: "Llenar fecha de fin",
              }
          },
          
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
          /*
           var name = e.getAttribute("name");
           var editar=false;
           if (name>0) {
            editar=true;
           }else{
               editar=false;
           }
         */
            GuardarIncapacidad();
        },success: function(label){
           
            
        }
    }),
    $("#form_Tratamiento").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        
        rules:
        {
            txtTratamiento:{
                required:true,
            }
            
        },
        messages: {
       
            txtTratamiento: {
              required: "Llenar Tratamiento",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
          /*
           var name = e.getAttribute("name");
           var editar=false;
           if (name>0) {
            editar=true;
           }else{
               editar=false;
           }
         */
            GuardarTratamiento();
        },success: function(label){
           
            
        }
    }),
    $("#form_Diagnostico").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        
        rules:
        {
            txtDescripcionDiagnostico:{
                required:true,
            }
            
        },
        messages: {
       
            txtDescripcionDiagnostico: {
              required: "Llenar Descripcion",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
          /*
           var name = e.getAttribute("name");
           var editar=false;
           if (name>0) {
            editar=true;
           }else{
               editar=false;
           }
         */
            GuardarDiagnosticos();
        },success: function(label){
           
            
        }
    }),
    $("#form_Examenes_Fisicos").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        
        rules:
        {
            txtPariencia:{
                required:true,
            }
            
        },
        messages: {
       
            txtPariencia: {
              required: "Llenar Apariencia General",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
          /*
           var name = e.getAttribute("name");
           var editar=false;
           if (name>0) {
            editar=true;
           }else{
               editar=false;
           }
         */
            GuardarExamenFisico();
        },success: function(label){
           
            
        }
    }),
    $("#From_Antecedentes_Personales").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        
        rules:
        {
            txtApp:{
                required:true,
            },
            txtAF:{
                required:true,
            },
            txtAHGT:{
                required:true,
            }
            
        },
        messages: {
       
            txtApp: {
              required: "Por favor llenar este campo",
            },
            txtAF: {
                required: "Por favor llenar este campo",
              },
              txtAHGT:{
                required:"Por favor llenar este campo",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
          
           var name = e.getAttribute("name");
           var editar=false;
           if (name>0) {
            editar=true;
           }else{
               editar=false;
           }
         
            GuardarFormAntecedentesPersonales(editar,name);
        },success: function(label){
           
            
        }
    }),
    $("#FormularioPleclinica").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        rules:
        {
            txtIdentidad:{
                required:true,
                minlength:2
            },
            CbxTipoAtencion:{
                required:true,
            },
            motivo:{
                required:true,
                minlength:5
            },
            CodigoEmpleado:{
                required:true,
            },
            Nombre:{
                required:true,
            },
            Apellido:{
                required:true,
            }
            
        },
        messages: {
       
            txtIdentidad: {
              required: "La identidad es requerida",
              minlength:"Ingrese almenos 2 caracteres",
            },
            CbxTipoAtencion:{
                required: "Porfavor Seleccione Tipo de Atencion",
            },
            motivo:{
                required: "Ingrese Motivo de Visita",
                minlength:"minimo 5 caracteres",
            },
            CodigoEmpleado:{
                required:"Codigo de Empleado Requerido",
            },
            Nombre:{
                required:"Nombre es requerido",
            },
            Apellido:{
                required:"Apellido es Requerido",
            }
            
           
          },
          errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
           
            GuardarFormPreclinica();
        },success: function(label){
           
            
        }
    }),

    $("#FormIncapacidad").validate({
        lang: 'us',
        live: 'enabled',
        onkeydown:true,
        rules:
        {
            selectBusqueda:{
                required:true,
               
            },
            
        },
        messages: {
            
            selectBusqueda: {
              required: "Necesitamos obtener su Usuario",
             
            },
          

          },
          errorElement: "em",
          errorPlacement: function ( error, element ) {
              // Add the `help-block` class to the error element
              error.addClass( "help-block" );

              // Add `has-feedback` class to the parent div.form-group
              // in order to add icons to inputs
            
              // Add the span element, if doesn't exists, and apply the icon classes to it.
              if ( !element.next( "span" )[ 0 ] ) {
                  $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
              }
          },
          success: function ( label, element ) {
              // Add the span element, if doesn't exists, and apply the icon classes to it.
              if ( !$( element ).next( "span" )[ 0 ] ) {
                  $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
              }
          },submitHandler:function(e){
           
             buscarEmpleado();
           
        },
          highlight: function ( element, errorClass, validClass ) {
              $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
              $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
          },
          unhighlight: function ( element, errorClass, validClass ) {
              $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
              $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
          }
    }),
    $("#formLOgin").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        rules:
        {
            usuario:{
                required:true,
                minlength:2
            },
            Contrasenia:{
                required:true,
                minlength:2
            }
            
        },
        messages: {
            
            usuario: {
              required: "Necesitamos obtener su Usuario",
              minlength:"Ingrese almenos 2 caracteres",
            },
            Contrasenia:{
                required: "Necesitamos obtener su Contrase&ntilde;a",
                minlength:"Ingrese almenos 2 caracteres",
              }

          },errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
           
            muyfunction();
        },success: function(label){
           
            
        }
    }),
    $("#formcambio").validate({
        lang: 'es',
        live: 'enabled',
        onkeydown:true,
        rules:
        {
            ActualPssw:{
                required:true,
                minlength:2
            },
            pswNueva:{
                required:true,
                equalTo: "#pswConfirmar"
            },
            pswConfirmar:{
                required:true,
                equalTo: "#pswNueva"
            }
        },
        messages: {
            name: "Please specify your name",
            ActualPssw: {
              required: "Necesitamos obtener su clave ",
              minlength:"Ingrese almenos 2 caracteres",
            },
            pswNueva: {
                required:'Debe confirmar la contrase&ntilde;a',
                equalTo: "Ingrese Contrase&ntilde;a igual"
            },
            pswConfirmar: {
                required:"Debe confirmar la contrase&ntilde;a",
                equalTo: "Ingrese Contrase&ntilde;a igual"
            }

          },errorPlacement:function(e,r)
        {
            
            
          /*  $('#BtnGuardarCambio').attr('disabled', true); */
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },onkeyup: function(element){
            this.element(element);
    
        },invalidHandler:function(e,r)
        {
           
            $("#kt_form_denis_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){
           
            opp();
        },success: function(label){
           
            
        }
    }),
    $("#kt_form_1").validate({
        lang: 'es',
        rules:
        {
            email:{
                required:true,
                email:true,
                minlength:50,
                placeholder: 'Your email address'},
            url:{required:!0},
            digits:{required:!0,digits:!0},
            creditcard:{required:!0,creditcard:!0},
            phone:{required:!0,phoneUS:!0},
            option:{required:!0},
            options:{required:!0,minlength:2,maxlength:4},
            memo:{required:!0,minlength:10,maxlength:100},
            checkbox:{required:!0},
            checkboxes:{required:!0,minlength:1,maxlength:2},
            radio:{required:!0}
        },
        messages: {
            name: "Please specify your name",
            email: {
              required: "Necesitamos obtener el mail",
              email: "Tu Email tiene que tener un formato name@domain.com",
              minlength:"debe tener menos de 80",
            }
          },errorPlacement:function(e,r)
        {
            var i=r.closest(".input-group");
            i.length?i.after(e.addClass("invalid-feedback")):r.after(e.addClass("invalid-feedback"))
        },invalidHandler:function(e,r)
        {
            $("#kt_form_1_msg").removeClass("kt--hide").show(),KTUtil.scrollTop()
        },submitHandler:function(e){}
    }),$("#kt_form_2").validate(
        {
            rules:{billing_card_name:{required:!0},
            billing_card_number:{required:!0,creditcard:!0},
            billing_card_exp_month:{required:!0},
            billing_card_exp_year:{required:!0},
            billing_card_cvv:{required:!0,minlength:2,maxlength:3},
            billing_address_1:{required:!0},
            billing_address_2:{},billing_city:{required:!0},
            billing_state:{required:!0},
            billing_zip:{required:!0,number:!0},
            billing_delivery:{required:!0}},
            invalidHandler:function(e,r){
                swal.fire(
                {
                    title:"",
                    text:"There are some errors in your submission. Please correct them.",
                    type:"error",
                    confirmButtonClass:"btn btn-secondary",
                    onClose:function(e)
                    {
                        console.log("on close event fired!")
                    }
                }),e.preventDefault()
            },submitHandler:function(e)
            {
                return swal.fire(
                    {
                        title:"",
                        text:"Form validation passed. All good!",
                        type:"success",
                        confirmButtonClass:"btn btn-secondary"
                    }
                    ),!1}
            }
        )
        
    }
};jQuery(document).ready(function(){KTFormControls.init()});