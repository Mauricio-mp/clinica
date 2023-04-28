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
//require_once("models/techo.model.php");

  function run(){
    $cuenta=[];
  	$opcion =$_GET['op'];


    switch ($opcion) {
    
      
    
    	default:

    		renderizar("validador",$cuenta);
    		break;
    }


    
  }


  run();
?>
