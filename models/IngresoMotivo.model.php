<?php 

session_start();
ob_start();
  require_once("libs/dao.php");

function FunctionInsertMotivo($txtMotivo,$id){
    
    $dbConn= connect();
   
    $sql = $dbConn->prepare("INSERT INTO public.motivo (descripcion,fecha_creacion,usuario_creacion,estado)
     VALUES(:descripcion,NOW(),:usuario, true )");
    
    
    
$sql->execute(["descripcion"=>$txtMotivo,"usuario"=>$id]); 

    if($sql=true){
        return true;
    }else{
    return false;
    }
}


function ListaMotivos(){
    $dbConn= connect();
   
    $sql = $dbConn->prepare("SELECT * FROM public.motivo WHERE estado=true");
    
    
    
$sql->execute();
$sql->setFetchMode();
   
    $fila=$sql->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);
    
    return $fila;


}


?>