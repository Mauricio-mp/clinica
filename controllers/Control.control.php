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
    $Control= new Recibir();

    switch ($opcion) {
      case 'llenar':
        
        
       $arrayName = array('data' => $Control->mostrarInfo($json[0]['id_usuario']));
      echo json_encode($arrayName);
        break;
        case 'llenarPreclinica':
         $id=$_POST['id'];
          $arrayName = array('data' => $Control->BuscarPreclinicas($id));
          echo json_encode($arrayName);
          break;
        case 'DetallePreclinica':
          $idPreclinica=$_POST['idPreclinica'];
       
          $datos=$Control->Detallepreclinica($idPreclinica);
          echo json_encode($datos);
        break;
        case 'guardarANtecedente':
          $id=$_POST['idExpediente'];
          $txtApp=$_GET['txtApp'];
          $txtAF=$_GET['txtAF'];
          $txtAHGT=$_GET['txtAHGT'];
          $txtAlergias=$_GET['txtAlergias'];
          $txtVacunas=$_GET['txtVacunas'];
          $txtAE=$_GET['txtAE'];
          $txtHabitosToxicos=$_GET['txtHabitosToxicos'];
          $habitosnoToxicos=$_GET['habitosnoToxicos'];
          $txtHabitosSaludables=$_GET['txtHabitosSaludables'];
          $AntGo=$_GET['AntGo'];

          $msg=$Control->GuardarAntecedentesPersonales($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);
          print_r($msg);
          break;

          case 'Antecedentes':
            $exp=$_POST['id'];
            $arrayName = array('data' => $Control->MostrarAntecedentes($exp,$unico=false));
            echo json_encode($arrayName);
            break;

            case 'MostrarDatosActualizar':
              $id= $_POST['id'];
              $arrayName = array('data' => $Control->MostrarAntecedentes($id,$unico=true));
            echo json_encode($arrayName);
              break;
        case 'EditarANtecedente':
          $id= $_POST['id'];
          $txtApp=$_GET['txtApp'];
          $txtAF=$_GET['txtAF'];
          $txtAHGT=$_GET['txtAHGT'];
          $txtAlergias=$_GET['txtAlergias'];
          $txtVacunas=$_GET['txtVacunas'];
          $txtAE=$_GET['txtAE'];
          $txtHabitosToxicos=$_GET['txtHabitosToxicos'];
          $habitosnoToxicos=$_GET['habitosnoToxicos'];
          $txtHabitosSaludables=$_GET['txtHabitosSaludables'];
          $AntGo=$_GET['AntGo'];


          $msg=$Control->ActualizarAntecedente($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);
          print_r($msg);
         break;
        case 'AnularAncedente':
          $idAntecedente=$_POST['idAntecedente'];
          $msg=$Control->AnularAntecedente($idAntecedente);
          print_r($msg);
        case 'llenarexamenesFisicos':
          $id=$_POST['id'];
      
          $arrayName = array('data' => $Control->LLenarExamenFisico($id,$unico=true));
          echo json_encode($arrayName);
          break;
          break;
  
    	default:
    	renderizar("Control",$datos);
    		break;
    }























    
  }


  run();
?>
