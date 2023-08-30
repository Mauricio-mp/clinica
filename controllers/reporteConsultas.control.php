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
addToContext("page_title","Reporte Por tipo de Atenciones");
  require_once("libs/template_engine.php");
require_once("models/ReporteConsulta.model.php");
  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $json = json_decode($_COOKIE['user_logged'],true);
   
    $obj= new Consulta();
    $datos['anios']=$obj->mostrarAnio();
switch ($opcion) {
 
  case 'mostrardatos':
    $mes=$_POST['mes'];
    $CbxAnios=$_POST['CbxAnios'];



   for ($i=0; $i <count($mes) ; $i++) {   
      $cost .= '\''.$mes[$i].'\''. ',';  
    }
    $myString = substr($cost, 0, -1);


    $datos['mostrar']=$obj->mostrarInfo($CbxAnios,$myString);
    
    $_SESSION['ReportesConsultas']=$datos['mostrar'];
   
  //  print_r('<pre>');
  //  print_r($datos['mostrar']);
  //  print_r('</pre>');
  renderizar("ReporteConsulta",$datos);
    break;
  
   

    break;
  default:
  renderizar("ReporteConsulta",$datos);
    break;
}



    

  
  }

  run();
?>



