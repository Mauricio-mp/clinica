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
addToContext("page_title","Reporte General Por Incapacidades");
  require_once("libs/template_engine.php");
require_once("models/reporteCllinica.model.php");
  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $json = json_decode($_COOKIE['user_logged'],true);


switch ($opcion) {
  case 'prueba':
    $datos['mostrar']=true;
    $inicio=$_POST['FechaInicio'];
    $fin=$_POST['FechaFin'];
    $obj= new Recibir();
    $datos['mostrar']=$obj->Mostrardatos($inicio,$fin);
    $_SESSION['datosPorPreclinica']=$datos['mostrar'];
    renderizar("RepoClinica",$datos);
    break;
 
  
  default:
  renderizar("RepoClinica",$datos);
    break;
}



    

  
  }

  run();
?>



