<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");


	interface cita
	{
		public function mostrarInfiEmpleados();

	}
class clinica extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
    } 



	public function mostrarInfiEmpleados(){
		try {

      $conn= self::SQLServer();
      $sql=mssql_query("SELECT cempno,cfname,clname,cstatus from prempy where cstatus='A'");

      while($fila=mssql_fetch_array($sql)){
		$fila[1]=utf8_encode($fila[1]);
		$fila['cfname']=utf8_encode($fila['cfname']);
		$fila[2]=utf8_encode($fila[2]);
		$fila['clname']=utf8_encode($fila['clname']);
        $arr[]=$fila;
      }
      return $arr;
  


 
		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}



}
 ?>

