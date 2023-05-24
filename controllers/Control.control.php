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
addToContext("page_title","Lista de Expedientes");
  require_once("libs/template_engine.php");
require_once("models/Control.model.php");
  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $json = json_decode($_COOKIE['user_logged'],true);
    $Recibir= new Recibir();

    switch ($opcion) {
      case 'llenar':
        
        
       $arrayName = array('data' => $Recibir->mostrarInfo($json[0]['id_usuario']));
      echo json_encode($arrayName);
        break;
        case 'llenarPreclinica':
          $id=$_POST['id'];
          $arrayName = array('data' => $Recibir->mostrarInfo($id));
          echo json_encode($arrayName);
          break;
    	default:
    	renderizar("Control",$datos);
    		break;
    }























    
  }


  run();
?>
