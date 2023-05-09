<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfo();

	}
class Registro extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
	} 

	
	
public function mostrarInfo()
{
    $conn= self::connect();
		$sql=$conn->prepare("SELECT tp.pidenticacion,tp.pcodigo,tp.pnombre,tp.papellido,sv.motivo,sv.observacion,sv.fechacreacion from public.tb_persona tp
        INNER JOIN public.tb_signosvitales sv
        ON tp.pidpersona=CAST (sv.tb_persona AS INTEGER)
        order by tp.pfechacreacion DESC");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		
   return $filas;
}




}
 ?>

