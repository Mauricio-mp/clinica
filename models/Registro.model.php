<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfo();
		public function doctores();
		public function GuardarTraslado($id,$idPreclinica,$usuarioTraslado);
		public function AnularSignos($id);
		public function DetalleSignos($id);
		public function FinalizarUnExpediente($estado,$id);
	}
class Registro extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
	} 
	public function FinalizarUnExpediente($estado,$id) {
		try {
			$conn= self::connect();
			$sql=$conn->prepare("UPDATE tb_signosVitales set finalizado=:finalizar where pid=:id");
			$sql->execute(["id"=>$id,"finalizar"=>time()]);

				$actualizarcita=$conn->prepare("UPDATE tb_signosVitales set estado=:estado where pid=:id");
			
		
				$actualizarcita->execute(["id"=>$id,"estado"=>4]);
			
			
			return ($actualizarcita) ? true : 0;
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function DetalleSignos($id)
	{
		try {
		$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_signosvitales ts 
		inner join public.tb_persona tp 
		on CAST(ts.tb_persona AS INTEGER)  = tp.pidpersona
		and ts.pid=:id");
		$sql->execute(["id"=>$id]);
		
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	
	public function AnularSignos($id)
	{
		try {
			$conn= self::connect();
			$sql=$conn->prepare("UPDATE tb_signosVitales set anulado=false where pid=:id");
			
		
				$sql->execute(["id"=>$id]);
			
			return ($sql) ? true : 0;
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
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
		$sql=$conn->prepare("SELECT sv.pId, tp.pidenticacion,tp.pcodigo,tp.pnombre,tp.papellido,sv.motivo,sv.observacion,TO_CHAR (sv.fechacreacion, 'dd/mm/YYYY HH12:MI AM') as fechacreacion,sv.estado,sv.anulado,sv.tipodeatencion,tc.cnombre as atencion  from public.tb_persona tp
		INNER JOIN public.tb_signosvitales sv
		ON tp.pidpersona=CAST (sv.tb_persona AS INTEGER)
		inner join public.tb_catalogos tc 
		on tc.cid =sv.tipodeatencion 
		and sv.estado IN(1,2,3,4)
        and sv.anulado=true
		order by tp.pfechacreacion DESC");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		
   return $filas;
}




}
 ?>

