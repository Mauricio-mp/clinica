<?php
// ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
 //error_reporting(E_ALL);
ini_set('session.gc_maxlifetime', 28800);
    session_start();
    ob_start();
    require_once("libs/utilities.php");
    $val=$_GET['instruccion'];
    $cokkie=json_decode($_COOKIE['user_logged'],true);


    (isset($_GET["page"])) ? $pageRequest = $_GET["page"]:  $pageRequest = "micuenta";

   if(!empty($cokkie)){
   
   if ($cokkie[0]['cambiocontrasenia']==false and $_GET["page"]=="logout") {
   $pageRequest="logout";
   } else if($cokkie[0]['cambiocontrasenia']==false and $_GET["page"]!="logout"){
    $pageRequest="cambio";
   }
   }


    //Incorporando los midlewares son codigos que se deben ejecutar
    //Siempre
    require_once("controllers/verificar.mw.php");
    require_once("controllers/site.mw.php");


    //Este switch se encarga de todo el enrutamiento
    switch($pageRequest){
        case 'reporteConsultas':
            if(mw_estaLogueado()) {
                require_once("controllers/reporteConsultas.control.php");
            }else{
                redirectToUrl('index.php');
            }
        break;
        case 'EmpleadoExistente':
            if(mw_estaLogueado()) {
                require_once("controllers/EmpleadoExistente.control.php");
            }else{
                redirectToUrl('index.php');
            }
        break;
        case 'reporteClinica':
            if(mw_estaLogueado()) {
                require_once("controllers/reporteClinica.control.php");
            }else{
                redirectToUrl('index.php');
            }
            break;
        case 'reporteGeneral':
            if(mw_estaLogueado()) {
                require_once("controllers/reporteGeneral.control.php");
            }else{
                redirectToUrl('index.php');
            }
            break;
        case 'Control':
            if(mw_estaLogueado()) {
               require_once("controllers/Control.control.php");
           }else{
               redirectToUrl('index.php');
           }
      
           break;
        case 'recibir':
            if(mw_estaLogueado()) {
               require_once("controllers/recibir.control.php");
           }else{
               redirectToUrl('index.php');
           }
      
           break;
        case 'cambio':
             if(mw_estaLogueado()) {
                require_once("controllers/cambio.control.php");
            }else{
                redirectToUrl('index.php');
            }
       
            break;
        case 'reporte':
            if(mw_estaLogueado()) {
                require_once("controllers/reporte.control.php");
            }else{
                redirectToUrl('index.php');
            }
            break;
        case 'Registro':
            if(mw_estaLogueado()) {
                require_once("controllers/registro.control.php");
            }else{
                redirectToUrl('index.php');
            }
            break;
        case "home":
            //llamar al controlador
            if(mw_estaLogueado()) {
                require_once("controllers/home.control.php");
            }else{
                redirectToUrl('index.php');
            }
            //die();  
            
            break;
        case "micuenta":   
            require_once("controllers/micuenta.control.php");
            break;
            case "cita":
                if(mw_estaLogueado()) {
                    require_once("controllers/cita.control.php");
                }else{
                    redirectToUrl('index.php');
                }
                
                break;
            case "validador":
                if(mw_estaLogueado()) {
                    require_once("controllers/validador.control.php");
                }else{
                    redirectToUrl('index.php');
                }
                break;
            case "cliente":
                    require_once("controllers/reporte.control.php");
                break;
            case "clientes":
                   require_once("controllers/clientes/clientes.control.php");
                break;
            case "logout":
            mw_setEstaLogueado("","",true);

            redirectToUrl('index.php');
            die();

                break;
        default:
            require_once("controllers/error.control.php");
    }
?>
