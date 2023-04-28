function opp() {

var ActualPssw = $('#ActualPssw').val();
var pswNueva = $('#pswNueva').val();
var pswConfirmar = $('#pswConfirmar').val();

$.post("index.php?page=cambio&op=guardar", {
    ActualPssw: ActualPssw,
    pswNueva:pswNueva,
    pswConfirmar:pswConfirmar              
})
.done(function(data) {
    (data)? showSuccessToast('Clave Actualizada con exito'):showDangerToast('data');
    setTimeout(() => {
      
            window.location.href='index.php?page=logout';
        
        
      }, "4000");

});
}






function presion(event) {


	optenervalor = event.value

                $.post("index.php?page=cambio&op=Verificarpsw", {
                        Password: optenervalor                   
                    })
                    .done(function(data) {
						
                       
					    var datas = JSON.parse(data);
                        if (datas.Password == 0) {
                            val = 0;
                            $("#TextoValiPswAnterior").css({
                                'color': 'black',
                                'font-weight': 'bold'
                            });
                            $("#TextoValiPswAnterior").text('Contraseña Correcta');

                        }
                        console.log(datas.Password);
                        if (datas.Password != 0) {
                            val = 1;
                            $("#TextoValiPswAnterior").css({
                                'color': 'red',
                                'color': 'red',
                                'font-weight': 'bold'
                            });
                            $("#TextoValiPswAnterior").text('Contraseña Incorrecta');
                        }

						

                    });
}

function confirmar(confirmar) {
	var optenernueva = $('#pswNueva').val();
	var confirmar = confirmar.value;



	if (optenernueva == confirmar) {

		$("#Verpassword").css({
			'color': 'black',
			'color': 'black',
			'font-weight': 'bold'
		});
		$("#Verpassword").text('Las Contraseñas Coinciden');


	}
	if (optenernueva != confirmar) {

		$("#Verpassword").css({
			'color': 'red',
			'color': 'red',
			'font-weight': 'green'
		});
		$("#Verpassword").text('Las Contraseñas No Coinciden');
	}

	

}