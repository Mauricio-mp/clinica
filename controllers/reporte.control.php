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

  require_once("libs/template_engine.php");
require_once("models/reporte.model.php");
addToContext("page_title","Personal - Reporte");
addToContext("form_title","Reporte");

  function run(){
    $cuenta=[];
  	$opcion =$_GET['op'];
    $cuenta['id']=$_GET['id'];
    switch ($opcion) {
      case 'BuscarIncapacidad':
  

      $arr = explode('-', $_POST['rango']);
      $desgloseInicio=explode('/', $arr[0]);
      $desgloseFin=explode('/', $arr[1]);
       
       $diaInicio=$desgloseInicio[0];
       $mesInicio=$desgloseInicio[1];
       $anioInicio=$desgloseInicio[2];

    
       $diaFin=$desgloseFin[0];
       $mesFin=$desgloseFin[1];
       $anioFin=$desgloseFin[2];

       $fechaFin=$anioFin.'-'.$mesFin.'-'.trim($diaFin);
       $fechaInicio=date("Y-m-d",strtotime($mesInicio.'/'.$diaInicio.'/'.$anioInicio));

       $cuenta['fechainicio']=trim($fechaInicio);
       $cuenta['fechafin']=trim($fechaFin);
       $cuenta['id']=$_GET['id'];

       $obReporte = new Reporte();
      
       $cuenta['Mostrar']= $obReporte->getDatos(trim($fechaFin),trim($fechaInicio));
   
       // print_r($fechaFin);
      /// print_r(prueba('0318-1994-1214',2,'sasd','dsdsd'));


      renderizar("reporte",$cuenta);

       
        break;

        case 'abrirpdf':
          $fechainicio=$_GET['fechainicio'];
          $fechafinal=$_GET['fechafinal'];
          $id=$_GET['id'];

          print_r(prueba($fechainicio,$fechafinal,$id));
     
         
          break;
    	default:

    		renderizar("reporte",$cuenta);
    		break;
    }


    
  }


  run();
?>