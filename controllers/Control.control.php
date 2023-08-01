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
    $datos['fecha']=date('Y-m-d');

    switch ($opcion) {
      case 'FinExpediente':
        $id=$_POST['id'];
        $msg=$Control->FinExpediente($id);
        print_r($msg);
      break;
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
          case 'guardarFisicos':
            $fisicos = array(
            "txtPariencia"=> $_GET['txtPariencia'],
            "txtCabeza"=> $_GET['txtCabeza'],
            "txtCuello"=> $_GET['txtCuello'],
            "txtTorax"=> $_GET['txtTorax'],
            "txtCorazon"=> $_GET['txtCorazon'],
            "txtPulmones"=> $_GET['txtPulmones'],
            "txtmamas"=> $_GET['txtmamas'],
            "txtmamas"=> $_GET['txtmamas'],
            "txtabdomen"=> $_GET['txtabdomen'],
            "txtGenilates"=> $_GET['txtGenilates'],
            "txtOsteomuscular"=> $_GET['txtOsteomuscular'],
            "txtExtremidades"=> $_GET['txtExtremidades'],
            "txtPielFaneas"=> $_GET['txtPielFaneas'],
            "txtNeurologico" =>$_GET['txtNeurologico'],
            "expediente"=>$_POST['expediente']
             );

             $msg=$Control->GuardarExamenFisico($fisicos);
             print_r($msg);
            break;
          case 'mostrarExamenfisico':
            $id=$_POST['id'];
            $arrayName = $Control->LLenarExamenFisico($id,$unico=false);
            print_r(json_encode($arrayName));
            break;
          case 'UpdateExamenFisico':
            $fisicos = array(
              "txtPariencia"=> $_GET['txtPariencia'],
              "txtCabeza"=> $_GET['txtCabeza'],
              "txtCuello"=> $_GET['txtCuello'],
              "txtTorax"=> $_GET['txtTorax'],
              "txtCorazon"=> $_GET['txtCorazon'],
              "txtPulmones"=> $_GET['txtPulmones'],
              "txtmamas"=> $_GET['txtmamas'],
              "txtabdomen"=> $_GET['txtabdomen'],
              "txtGenilates"=> $_GET['txtGenilates'],
              "txtOsteomuscular"=> $_GET['txtOsteomuscular'],
              "txtExtremidades"=> $_GET['txtExtremidades'],
              "txtPielFaneas"=> $_GET['txtPielFaneas'],
              "txtNeurologico" =>$_GET['txtNeurologico'],
              "examenfisico"=>$_POST['id']
               );
               
               $msg=$Control->ActualizarFormExamenesFisicos($fisicos);
               print_r($msg);
            break;
            case 'aliminarexamenFisico':
              $idexamen=$_POST['idexamen'];
              print_r($Control->EliminarExamenFisico($idexamen));
              break;
          case 'llenarexamenesLaboratoriales':
            $id=$_POST['id'];
            $arrayName = array('data' => $Control->LLenarExamenLaboratorial($id));
          echo json_encode($arrayName);

            break;
          case 'GuardarLaboratorios':
            
            $json = array(
              "txtHemograma"=>$_GET['txtHemograma'],
              "txtQuimica"=>$_GET['txtQuimica'],
              "txtOrina"=>$_GET['txtOrina'],
              "txtHeses"=>$_GET['txtHeses'],
              "txtCovid"=>$_GET['txtCovid'],
              "txtOtros"=>$_GET['txtOtros'],
              "expediente"=>$_POST['GlobalExpediente'],
              "usuario"=>$json[0]['id_usuario']
            );

            $msg=$Control->GuardarExamenLaboratorio($json);


          print_r($msg);

            

            break;
            case 'anularlab':
              $id=$_POST['id'];
              $msg=$Control->AnularLab($id);
              print_r($msg);
              break;
          case 'getdetalleLaboratorio':
            $id=$_POST['id'];
            $msg=$Control->MostrarDetalleLaboratorio($id);
            echo json_encode($msg);
            break;
        case 'EditarLaboratorios':
          $GlobalLaboratorio=$_POST['GlobalLaboratorio'];
          $txtHemograma=$_GET['txtHemograma'];
          $txtQuimica=$_GET['txtQuimica'];
          $txtOrina=$_GET['txtOrina'];
          $txtHeses=$_GET['txtHeses'];
          $txtCovid=$_GET['txtCovid'];
          $txtOtros=$_GET['txtOtros'];

          $array=array($GlobalLaboratorio,$txtHemograma,$txtQuimica,$txtOrina,$txtHeses,$txtCovid,$txtOtros);
          $msg=$Control->UpdateLaboratorio($array);

          print_r($msg);
          break;
          case 'GuardarDiagnostico':
            $descripcion=$_GET['txtDescripcionDiagnostico'];
            $id=$_POST['id'];
            $msg=$Control->GuardarDiagnostico($descripcion,$id);
            print_r($msg);
            break;
          case 'motrarincapacidad':
            $GlobalExpediente=$_POST['GlobalExpediente'];
            $msg=$Control->MotrarDiagnosticoActual($GlobalExpediente);
            echo json_encode($msg[0]['diagnostico']);
            break;
        case 'GuardarTratamiento':
          $tratamiento= $_POST['txtTratamiento'];
          $id=$_GET['id'];
          $msg=$Control->UpdateTratamiento($tratamiento,$id);
          print_r($msg);
        break;
        case 'motrarTratamiento':
          $GlobalExpediente=$_POST['GlobalExpediente'];
          $msg=$Control->MotrarTratamiento($GlobalExpediente);
          echo json_encode($msg[0][tratamiento]);
          break;    
        case 'GuardarIncapacidad':
          $FechaInicio=$_POST['FechaInicio'];
          $FechaFin=$_POST['FechaFinIncapacidad'];
          $txtincapacidad=$_POST['txtincapacidad'];
          $id=$_GET['id'];
          $msg=$Control->GuardarIncapacidad($FechaFin,$FechaInicio,$txtincapacidad,$id);
          print_r($msg);
          break;  
    	default:
    	renderizar("Control",$datos);
    		break;
    }























    
  }


  run();
?>
