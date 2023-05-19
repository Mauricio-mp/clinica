<?php
/* Home Controller
* 2014-10-14
* Created By OJBA
* Last Modification 2014-10-14 20:04
*/
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);  
session_start();
ob_start();
 require_once("libs/template_engine.php");
 require_once("models/micuenta.model.php");

 function run(){

 	$opcion=$_POST['op'];
	//$opcion='login';
  $cuenta=[];

switch ($opcion) {
	case 'login':
		 $usuario=$_POST['usuario'];
		 $contrasenia=$_POST['contra'];
		 
		 $consulta= new Verificacion();
		 //echo $consulta->GetVarificacion($usuario,$contrasenia);     
	
print_r($consulta->GetVarificacion($usuario,$contrasenia));

        // $cuenta['usuario']=GetVarificacion($usuario,$contrasenia);
         
		
		break;
	default:
		renderizar("micuenta",$cuenta);
		break;
}

  

  
 }
 run();
?>
