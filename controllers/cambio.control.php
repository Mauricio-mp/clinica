<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */
// ini_set('display_errors', 1);
 //ini_set('display_startup_errors', 1);
 //error_reporting(E_ALL); 
session_start();
ob_start();

  require_once("libs/template_engine.php");
require_once("models/cambio.model.php");

addToContext("page_title","cambio Contrasenia");
addToContext("form_title","clinica");


  function mostrar(){
    $cuenta=[];
    $accion=$_GET['accion'];
    ($accion)? $cuenta['url']="history.back()" : $cuenta['url']="location.href='index.php?page=logout&instruccion=1'";
  	$opcion =$_GET['op'];
    $cokkie=json_decode($_COOKIE['user_logged'],true);
  
    switch ($opcion) {
      case 'guardar':
        $ActualPssw= $_POST['ActualPssw'];
        $pswNueva=  $_POST['pswNueva'];
        $pswConfirmar= $_POST['pswConfirmar'];
        $consulta=new cambio();
        $optenerPsw=$consulta->consultarClave($ActualPssw,$cokkie[0]['id_usuario']);
        $data = array(
          'Password' => $optenerPsw
    
          );

        if ($data['Password']==1) {
          echo utf8_encode("Contraseña incorrecta");

        }else{
          $actualizarCambio=$consulta->actualizarContra($pswConfirmar,$cokkie[0]['id_usuario']);
          print_r($actualizarCambio);
        }

        break;
      case 'anular':
      $codigo=$_POST['codigo'];


          break;
      case 'Verificarpsw':
          $Password= $_POST['Password'];
          $consulta=new cambio();
          $optenerPsw=$consulta->consultarClave($Password,$cokkie[0]['id_usuario']);

          $data = array(
            'Password' => $optenerPsw
      
            );
            
      
            //Devolvemos el array pasado a JSON como objeto
            echo json_encode($data, JSON_FORCE_OBJECT);

        break;    
    	default:

    		renderizar("cambio",$cuenta);
    		break;
    }


    
  }


  mostrar();
?>
