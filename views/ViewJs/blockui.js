
      
    $("#kt_blockui_1_5").click(function()
    {
        /* KTApp.block("#kt_blockui_1_content",{overlayColor:"#000000",type:"v2",state:"primary",message:"Por favor Espere..."})  */
        
        var txtCantidad=$('#txtCantidad').val();
        var txtDescripcionMotivo=$('#txtDescripcionMotivo').val();
    
        $.post("index.php?page=techo&op=IngresoNuevo", {
           txtCantidad:txtCantidad,
           txtDescripcionMotivo:txtDescripcionMotivo
        }, function(response) {
            if(response==1){
                KTApp.block("#kt_blockui_1_content",{overlayColor:"#000000",type:"v2",state:"primary",message:"Por favor Espere..."}),
                setTimeout(function(){KTApp.unblock("#kt_blockui_1_content")},150)

                $('#tablatechos').load('index.php?page=techo #tablatechos');
                showSuccessToast('Agregado con exito ');
                $('#txtCantidad').val('');
                $('#txtDescripcionMotivo').val('');
            }else{
                
               /// showDangerToast(response);
             console.log(response);
            }
        });

       
    })




