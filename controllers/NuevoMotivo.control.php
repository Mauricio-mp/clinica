<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
session_start();
ob_start();

  require_once("libs/template_engine.php");
require_once("models/IngresoMotivo.model.php");


  function run(){
    $cuenta=[];
  	$opcion =$_GET['op'];
    define('USUARIO_SESSION', $_SESSION['usuario']);
    //$array=ListaMotivos();
    $cuenta['listaMotivo']=ListaMotivos();
    //$cuenta['listaMotivo']['descripcion']='PRUEBAA';
    
  



    switch ($opcion) {
      case 'NuevoMotivo':
        
        $txtMotivo=$_POST['txtMotivo'];
        if($txtMotivo==true){
            $mesaje=FunctionInsertMotivo($txtMotivo,USUARIO_SESSION);
            echo $mesaje;
        }   
       
       
        break;
      
    	
    	default:

    		renderizar("Motivo",$cuenta);
    		break;
    }


    
  }


  run();
?>
