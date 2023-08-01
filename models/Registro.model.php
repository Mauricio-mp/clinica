<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfo();
		public function doctores();
		public function GuardarTraslado($id,$idPreclinica,$usuarioTraslado);
	}
class Registro extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
	} 
	
	public function GuardarTraslado($id,$idPreclinica,$usuarioTraslado)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("INSERT INTO public.tb_Expediente_traslado (pid_signosviatles,usuario_emisor,responsable,estado,fecha_traslado)
		 VALUES (:signosVitales,:usuario,:responsable,:estado,NOW())");
		$sql->execute(["signosVitales"=>$idPreclinica,"usuario"=>$usuarioTraslado,"responsable"=>$id,":estado"=>1]);
		
		if($sql==true){
			$actualizar=$conn->prepare("UPDATE public.tb_signosVitales set estado=2 where pid=:id");
			$actualizar->execute(["id"=>$idPreclinica]);
		}
		return ($sql) ? true : 0;

		
   return $filas;
		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}

	public function doctores()
{
    $conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.usuarios where medico=true and estado=true");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		
   return $filas;
}

public function mostrarInfo()
{
    $conn= self::connect();
		$sql=$conn->prepare("SELECT sv.pId, tp.pidenticacion,tp.pcodigo,tp.pnombre,tp.papellido,sv.motivo,sv.observacion,sv.fechacreacion,sv.estado  from public.tb_persona tp
		INNER JOIN public.tb_signosvitales sv
		ON tp.pidpersona=CAST (sv.tb_persona AS INTEGER)
		and sv.estado IN(1,2)
		order by tp.pfechacreacion DESC");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		
   return $filas;
}




}
 ?>

