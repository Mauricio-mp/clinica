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
  require_once("libs/template_engine.php");
require_once("models/cita.model.php");
addToContext("page_title","Incapacidad");
addToContext("form_title","Busqueda");


  function run(){
    $cuenta=[];
  	$opcion =$_GET['op'];
 // $opcion='empleado';
    $id=$_GET['id'];

  
  
    switch ($opcion) {
    case 'ActualizarSueldo':
      $FechaInicio=$_POST['FechaInicio'];
      $textdias=$_POST['textdias'];
      $op=new Incapacidad();
      $total =$op->ObtenerTotal($FechaInicio,$textdias);
      echo number_format($total,2);
      break;
      case 'mostrar':
        $op=new clinica();
        $codigoEmpleado=$_GET['codigoEmpleado'];
        $selectBusqueda=$_GET['selectBusqueda'];
        $identificacion=$_GET['identificacion'];
        $param=$_GET['param'];
        $total =$op->Busqueda($codigoEmpleado,$selectBusqueda,$identificacion,$param);
        $arrayName = array('data' => $total);
        echo json_encode($arrayName); 
 
        break;
     case 'Guardar':
      $FechaInicio=$_POST['FechaInicio'];
      $FechaFin=$_POST['FechaFin'];
      $txtNombre=$_POST['txtNombre'];
      $textCertificado=$_POST['textCertificado'];
      $textObservacion=$_POST['textObservacion'];
      $txtCodigoPatronal=$_POST['txtCodigoPatronal'];
      $textdias=$_POST['textdias'];
      $id=$_POST['id'];
 

      $op=new Incapacidad();
      $total =$op->ObtenerTotal($FechaInicio,$textdias);
    

   

      

      $Operacion = new Incapacidad($textdias,$FechaInicio,$FechaFin,$txtNombre,$textCertificado,$textObservacion,$txtCodigoPatronal,$id,$total);
     print_r($Operacion->GuardarInfo());
 
  
  
   
    
    
    
      break;
      case 'empleado':
        $cita= new clinica();

     
     echo json_encode($cita->mostrarInfiEmpleados());

        break;
    	default:
      /*
      if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="mp.hn"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Texto a enviar si el usuario pulsa el botón Cancelar';
        exit;
    } else {
      echo "<p>Hola {$_SERVER['PHP_AUTH_USER']}.</p>";
      echo "<p>Introdujo {$_SERVER['PHP_AUTH_PW']} como su contraseña.</p>";
    }
    */

    		renderizar("cita",$cuenta);
    		break;
    }


    
  }


  run();
?>
