<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL); 
session_start();
ob_start();
  require_once("libs/template_engine.php");
require_once("models/existente.model.php");
addToContext("page_title","Incapacidad");
addToContext("form_title","Busqueda");

  function run(){
    $cuenta=[];
      $opcion =$_GET['op'];
      $op=($opcion)? $opcion: 'DetalleEmpleado';
 // $opcion='empleado';
    $id=$_GET['id'];
    $clinicaNew=new Clinica();
    $cuenta['listaEStadoCivil']=$clinicaNew->GetListaEstadoCivil();
    $cuenta['TipoSanguineo']=$clinicaNew->GetListaSangre();
  
    switch ($op) {
      case 'guardarp':
        $txtIdentidad=$_POST['txtIdentidad'];
        echo $txtIdentidad;
        break;
        case 'DetalleEmpleado':

            $cuenta['detalle']=$clinicaNew->Busqueda(trim($id));
            // print_r('<pre>');
            // print_r($cuenta['detalle']);
            // print_r('</pre>');
            renderizar("existente",$cuenta);
            break;
      case 'mostrarTipoAtencion':
        $op=new Clinica();
        $msg=$op->mostrarxTipodeAtencion();
        echo json_encode($msg);
        break;
      case 'fecha':
        $idinput=$_POST['idinput'];

        $date1 = new DateTime(date('Y-m-d', strtotime($idinput)));
        $date2 = new DateTime();
        $diff = $date1->diff($date2);
        echo $diff->y."";
        break;
      case 'llenar':
        $inicio=time();
        setcookie("inicio",$inicio,time()+10800);
        //$_COOKIE["inicio"] = false;
        $codigoEmpleado=trim($_POST['codigo']);
        $identificacion=null;
        $param=null;
        $op=new clinica();
        $total =$op->Busqueda($codigoEmpleado,$selectBusqueda='Codigo',$identificacion,$param);
        $arrayName = array('data' => $total);
        echo json_encode($arrayName); 
 
        break;
    case 'ActualizarSueldo':
      $FechaInicio=$_POST['FechaInicio'];
      $textdias=$_POST['textdias'];
      $op=new Incapacidad();
      $total =$op->ObtenerTotal($FechaInicio,$textdias);
      echo number_format($total,2);
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
      case 'InPrec':
        //datos generales
        $CodigoEmpleado=$_POST['CodigoEmpleado'];
        $Nombre=$_POST['Nombre'];
        $Apellido=$_POST['Apellido'];
        $txtIdentidad=$_POST['txtIdentidad'];
        $FechaNacimiento=$_POST['FechaNacimiento'];
        $txtEdad=$_POST['txtEdad'];
        $txtSexo=$_POST['txtSexo'];
        $EstadoCivil=$_POST['EstadoCivil'];
        $txtOcupacion=$_POST['txtOcupacion'];
        $Dependencia=$_POST['Dependencia'];
        $txtReligion=$_POST['txtReligion'];
        $txtRaza=$_POST['txtRaza'];
        $txtTipoSanguineo=$_POST['txtTipoSanguineo'];
        $txtResidencia=$_POST['txtResidencia'];
        $txtTelefono=$_POST['txtTelefono'];
        $TipodeAtencion=$_POST['CbxTipoAtencion'];
         //Signos vitales
         $PA=$_POST['PA'];
         $FC=$_POST['FC'];
         $pulso=$_POST['pulso'];
         $FR=$_POST['FR'];
         $temperatura=$_POST['temparatura'];
         $Sp02=$_POST['Sp02'];
         $Glu=$_POST['Glu'];
         $peso=$_POST['peso'];
         $talla=$_POST['talla'];
         $imc=$_POST['imc'];
         $motivo=$_POST['motivo'];
         $txtObservacion=$_POST['txtObservacion'];

       

        $clinica= new Clinica();
        $registroGuardado=$clinica->UpdateEmpleado($txtIdentidad,$CodigoEmpleado,$Nombre,$Apellido,$FechaNacimiento,$txtEdad,$txtSexo,$EstadoCivil,$txtOcupacion,$Dependencia,$txtReligion,$txtRaza,$txtTipoSanguineo,$txtResidencia,$txtTelefono);
        //print_r($registroGuardado);

        print_r($clinica->guardarSignosVitales($_GET['id'],$PA,$FC,$pulso,$FR,$temperatura,$Sp02,$Glu,$peso,$talla,$imc,$motivo,$txtObservacion,$_COOKIE["inicio"],$TipodeAtencion));



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
   // print_r($_COOKIE["inicio"]);
            renderizar("existente",$cuenta);
          
    		break;
    }


    
  }

  run();
?>
