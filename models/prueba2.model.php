<?php
include_once 'libs/dao.php';

interface prueba2
{
    public function setfunction($id);
}

class Consulta extends Conexion implements prueba2
{

    function __construct(){
        $this->msg='';
    } 

    public function setfunction($id){
       
    try {
   
        $conn= self::connect();
        $sql=$conn->prepare("SELECT * from public.usuarios where id_usuario =:id");
        $sql->execute(["id"=>$id]);
        return $sql->fetchAll();
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    }


    
}
?>