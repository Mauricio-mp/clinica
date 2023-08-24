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
addToContext("page_title","Registro de Preclinicas");
  require_once("libs/template_engine.php");
require_once("models/recibir.model.php");
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
     case 'GuardarExpediente':
      $persona=$_POST['persona'];
      $id_usuario=$json[0]['id_usuario'];
      $SignosVitales=$_POST['SignosVitales'];
      $GlobalIdentidad=trim($_POST['GlobalIdentidad']);
      $txtSintomaPrincipal=$_GET['txtSintomaPrincipal'];
      $txtEnfermadadActual=$_GET['txtEnfermadadActual'];
      $txtFuncionesOrganicas=$_GET['txtFuncionesOrganicas'];
      $msg=$Recibir->verificarExpediente($GlobalIdentidad);
      if($msg==false){
        print_r($Recibir->guardarExpediente($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas));
        
      }else{
        print_r($Recibir->ExpedienteCreado($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas));
       
      }

      break;
    	default:
    	renderizar("recibir",$datos);
    		break;
    }























    
  }


  run();
?>
