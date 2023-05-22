<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo();

	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 

	public function mostrarInfo()
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT pid,et.usuario_emisor,et.estado,et.fecha_traslado,sv.motivo,sv.observacion,tp.pnombre,tp.papellido,tp.pidenticacion from public.tb_Expediente_traslado et
    INNER JOIN public.tb_signosvitales sv
    ON sv.pid=et.pid_signosviatles
    INNER JOIN public.tb_persona tp
    ON tp.pidpersona=CAST(sv.tb_persona AS INTEGER)
    where et.responsable=:responsable and et.estado=1");
		$sql->execute(["responsable"=>1]);
		
    $filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}







}
 ?>

