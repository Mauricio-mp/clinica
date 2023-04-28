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
addToContext("page_title","Ingreso Permiso");
  require_once("libs/template_engine.php");
require_once("models/Ingreso.model.php");


  function run(){
    $datos=[];
    $opcion =$_GET['op'];
    $datos['FechaInicial']=date('Y-m-d');
$end = date("d-m-Y");
$datos['FechaFinal']= date("Y-m-d",strtotime($end."+ 1 days")); 
   
    $datos['Motivo']=optenerMotivos();
    $usuario=$_POST['id'];
    //$GLOBALS['Tipo']=$_GET['Tipo'];
    $Tipo=$_GET['Tipo'];
   
    if($Tipo=='Dia'){
      $datos['dias']=TRUE;
      $datos['Hora']=FALSE;
    }else{
      $datos['dias']=FALSE;
      $datos['Hora']=TRUE;
    }
    
$datos['TipoOpcion']=$_GET['Tipo'];
$datos['id']=$_GET['id'];
$datos['Codigo']=$_GET['codigo'];
$datos['name']=$_GET['name'];
    switch ($opcion) {
      case 'IngresoNuevo':
        $val=0;
        $Tipo=$_POST['tipo'];
        $identidad=$_POST['id'];
        $Codigo=$_POST['Codigo'];
        //$string="2021-09-01 2:43 PM";
        //$string2= date("Y-m-d g:i a"); 
        $CbxMotivo=$_POST['CbxMotivo'];
        $Inicio=$_POST['Inicio'];
        $name=utf8_decode($_POST['name']);
        
        $Observacion=utf8_decode($_POST['Observacion']);
        $Fecha=date('Y-m-d',strtotime($_POST['Fecha']));
        $FechaInicial=$Fecha." ".$Inicio;
        $string1 =date("Y-m-d g:i a",strtotime($FechaInicial)); 

        $Fin=$_POST['Fin'];
        $FechaFinal=$Fecha." ".$Fin;
        $string2 =date("Y-m-d g:i a",strtotime($FechaFinal)); 
        $to_time = strtotime($string1);
$from_time = strtotime($string2);
$TotalMinutos= round(abs($to_time - $from_time) / 60,2);

        if(strtotime($Inicio)< strtotime('8:00 AM')){
          $val='la fecha ingresada es menor';
        }else if(strtotime($Fin)> strtotime('4:00 PM')){
          $val='la fecha ingresada es menor';
        }else{
$insert= IngresoPermiso($Tipo,$Inicio,$Fin,$TotalMinutos,$Observacion,date("Y-m-d g:i a",strtotime($string1)),date("Y-m-d g:i a",strtotime($string2)),$CbxMotivo,$Codigo,$identidad,$name);
        }


        
if($val!=0){
  print_r($val);
}else{
  print_r($insert);
}

        break;
      
      case 'IngresoDias':
        $CbxHabiles=$_POST['CbxHabiles'];
        $CbxMotivo=$_POST['CbxMotivo'];
        $Inicio=$_POST['Inicio'];
        $Fin=$_POST['Fin'];
        $Observacion=utf8_decode($_POST['Observacion']);
        $tipo=$_POST['tipo'];
        $identidad=$_POST['id'];
        $Codigo=$_POST['Codigo'];
        $name=utf8_decode($_POST['name']);
   
        $Insertar=IngresoPorDias($CbxHabiles,$CbxMotivo,$Inicio,$Fin,$Observacion,$tipo,$identidad,$Codigo,$name);
        print_r($Insertar);
   
        break;
    	default:

    	renderizar("Ingreso",$datos);
    		break;
    }























    
  }


  run();
?>
