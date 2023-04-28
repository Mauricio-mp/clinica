var queryString = window.location.search; 
var urlParams = new URLSearchParams(queryString); 
var id = urlParams.get('id');

function MyFunction(fechainicio,fechafin){
   
    document.getElementById("myDIV").innerHTML = "";
    var iframe = document.createElement('iframe');

// div tag in which iframe will be added should have id attribute with value myDIV
document.getElementById("myDIV").appendChild(iframe);

// provide height and width to it
iframe.setAttribute("src", "index.php?page=reporte&op=abrirpdf&fechainicio="+fechainicio+"&fechafinal="+fechafin+'&id='+id);
iframe.style.width = "100%";
iframe.style.height = "90em";

}

