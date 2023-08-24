<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 

session_start();
ob_start();
addToContext("page_title","Registro de Preclinicas");
  require_once("libs/template_engine.php");
require_once("models/reporteCllinica.model.php");
  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $json = json_decode($_COOKIE['user_logged'],true);


switch ($opcion) {
  case 'prueba':
    $datos['mostrar']=true;
    renderizar("RepoClinica",$datos);
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
  
  default:
  renderizar("RepoClinica",$datos);
    break;
}



    

  
  }

  run();
?>



