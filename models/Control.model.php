<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($id);
		public function BuscarPreclinicas($id);

	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	public function BuscarPreclinicas($id)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT ep.id_expediente,ep.pid_signos,tp.pidenticacion,tp.pnombre,tp.papellido,tp.pedad,ts.motivo,ts.observacion  from public.tb_expediente_preclinicas ep
		INNER JOIN public.tb_expediente e
		ON ep.id_expediente = e.id_expediente
		inner join public.tb_signosvitales ts 
		on ts.pid =ep.pid_signos 
		INNER JOIN public.tb_persona tp 
		ON tp.pidpersona =CAST (ts.tb_persona AS INTEGER)
		and ep.id_expediente=:id");
		$sql->execute(["id"=>$id]);
		
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
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

