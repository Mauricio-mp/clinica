<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		

	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 


	public function mostrarInfo($id)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_expediente where id_responsable=:id");
		$sql->execute(["id"=>$id]);
		
	$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$d = array_map('recorrer', $filas);
		return $d;

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}







}

function recorrer($array){
	$array['fechacreacion']=date('d/m/Y', strtotime($array['fechacreacion']));
	$array['hora']=date('h:m: a', strtotime($array['fechacreacion']));
return $array;
}
 ?>

