<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
*/
session_start();
ob_start();
addToContext("page_title","Reporte Mensual");
  require_once("libs/template_engine.php");
require_once("models/ReporteGeneral.model.php");
  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $json = json_decode($_COOKIE['user_logged'],true);
   
    $obj= new Recibir();
    $datos['anios']=$obj->mostrarAnio();

switch ($opcion) {
  case 'ExportExcel':

   



    break;
  case 'prueba':
    $datos['mostrar']=true;
    renderizar("General",$datos);
    break;
  case 'mostrar':
    $mes=$_POST['mes'];
    $CbxAnios=$_POST['CbxAnios'];

   for ($i=0; $i <count($mes) ; $i++) {   
      $cost .= '\''.$mes[$i].'\''. ',';  
    }
    $myString = substr($cost, 0, -1);

    
    
    $obj= new Recibir();
   // $obj->mostarcolumn();
    $msg=$obj->mostrarInfo($myString,$CbxAnios);
    $uniranio=$obj->unirconanio($msg);
    $unirTotales=$obj->unirTotales($uniranio);
   print_r('<pre>');
   print_r($unirTotales);
   print_r('</pre>');
    break;
  case 'mostrardatos':
    $obj= new Recibir();
    $datos['motivos']=$obj->mostrarmotivos($val=true);
    $CbxAnios=$_POST['CbxAnios'];
    $mes=$_POST['mes'];
    for ($i=0; $i <count($mes) ; $i++) {   
      $cost .= '\''.$mes[$i].'\''. ',';  
    }
    $myString = substr($cost, 0, -1);

    $info=$obj->mostrarnuevoInfo($myString,$CbxAnios);

    $msg=$obj->mostrarmotivos($val=false);
    $datos['val']=$obj->resultado($msg,$info,$CbxAnios);

    // print_r('<pre>');
    // print_r($datos);
    // print_r('</pre>');
    
  $_SESSION['motivos']=$datos['motivos'];
  $_SESSION['valores']= $datos['val'];
    $datos['val']=$obj->resultado($msg,$info,$CbxAnios);
    renderizar("General",$datos);
   

    break;
  default:
  renderizar("General",$datos);
    break;
}


    

  
  }

  run();
?>



