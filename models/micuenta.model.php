<?php 
session_start();
ob_start();

  require_once("libs/dao.php");
  header('Content-Type: text/html; charset=ISO-8859-1');
 define('METHOD','AES-256-CBC');
     define('SECRET_KEY','$Ministerio@2020');
     define('SECRET_IV','101712');


     
     


function GetVarificacion($usuario,$contrasenia){

   
   $dbConn= connect();
   $desencriptar= encriptar($contrasenia);
    $sql = $dbConn->prepare("SELECT * FROM public.usuarios WHERE usuario=:usuario AND contrasenia=:contrasenia and estado=:estado");

    
$sql->execute(['usuario' => $usuario,'contrasenia' => $desencriptar,'estado' => '1']); 

    $sql->setFetchMode(PDO::FETCH_ASSOC);
   
    $filas=$sql->fetchAll();
   if(empty($filas)){
   	return false;
   }else{
     $name=utf8_decode($filas[0]['nombrecompleto']);
     $_SESSION['nombre']=utf8_encode($name);
   	$rol=$filas[0]['idrol'];
//$_SESSION['user']=encriptar($filas[0]['id_usuario']);  
$_SESSION['user']=$filas[0]['id_usuario'];
$_SESSION['usuario']=$filas[0]['usuario'];

$consultaRol = $dbConn->prepare("SELECT * FROM public.roles_permisos WHERE id_rol =:rol");

    
$consultaRol->execute(['rol' => $rol]); 

    $consultaRol->setFetchMode(PDO::FETCH_ASSOC);
   
    $fila=$consultaRol->fetchAll();
    for ($i=0; $i <count($fila) ; $i++) { 
    	if($fila[$i]['id_permiso']==1){
    		$_SESSION['techo']=true;
        $_SESSION['mantenimiento']=true;
    	}
    	if($fila[$i]['id_permiso']==2){
    		$_SESSION['generar']=true;
    	}
        if($fila[$i]['id_permiso']==3){
            $_SESSION['anular']=true;
        }
    }

   	
   	return $desencriptar;
   }

}

interface Consultas
{
    public function GetVarificacion($usuario,$contrasenia);
   // public function encriptar($string);
   // public function desemcriptar($string);
}

class Verificacion extends Conexion implements Consultas
{
  function __construct(){
    $this->msg='';
    $this->contra='';
} 
public function desemcriptar($string){
  $output=FALSE;
  $key=hash('sha256', SECRET_KEY);
  $iv=substr(hash('sha256', SECRET_IV), 0, 16);
  $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
  return $output;
 }
public function encriptar($string){
  $output=FALSE;
  $key=hash('sha256', SECRET_KEY);
  $iv=substr(hash('sha256', SECRET_IV), 0, 16);
  $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
  $output=base64_encode($output);
  return $output;
 }
public function GetVarificacion($usuario,$contrasenia){
       
  try {

      $conn= self::connect();
      $this->contra=$this->encriptar($contrasenia);
      $sql=$conn->prepare("SELECT * from public.usuarios where usuario =:user and contrasenia=:contra and estado=true");
      $sql->execute(["user"=>$usuario,"contra"=>$this->contra]);
      $filas=$sql->fetchAll();
      if ($sql->rowCount() > 0) {
        setcookie("user_logged",json_encode($filas),time()+28800); //el tiempo esta en segundo convertir 8 horas * 3600 segundos=10800
      
      
        $rol=$filas[0]['idrol'];

        $consultaRol = $conn->prepare("SELECT * FROM public.roles_permisos WHERE id_rol =:rol");

    
$consultaRol->execute(['rol' => $rol]); 

    $consultaRol->setFetchMode(PDO::FETCH_ASSOC);
   
    $fila=$consultaRol->fetchAll();
    for ($i=0; $i <count($fila) ; $i++) { 
    	if($fila[$i]['id_permiso']==1){
    		$_SESSION['generar']=true;
        $_SESSION['citas']=true;
    	}
    	if($fila[$i]['id_permiso']==2){
    		$_SESSION['generar']=true;
    	}
        if($fila[$i]['id_permiso']==3){
            $_SESSION['anular']=true;
        }
    }
        return true;
      }else{
       
       return false;
      }
      
      //echo $_COOKIE['user_logged'];



    
  } catch (PDOException $exception) {
      exit($exception->getMessage());
  }
  }

}








  

?>