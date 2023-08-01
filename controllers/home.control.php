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

  function run(){
    $cuenta=json_decode($_COOKIE['user_logged'],true);
$id= $cuenta[0]['nombrecompleto'];
  	 $cuenta['page_title']='Home';

    addCssRef("css/home.css");
    $_SESSION['home']=$_SESSION['nombre'];

  // $info=getempleado($id);


  //print_r($_COOKIE['nombree']);

 renderizar("home",array("page_title"=>"inicio","Nombre"=>$id,"cuenta"=>"dmlopez@gmail.com"));
  }


  run();
?>
