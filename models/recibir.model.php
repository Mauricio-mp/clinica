<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($id);
		public function guardarExpediente($id_usuario,$SignosVitales);
	
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 

	public function guardarExpediente($id_usuario,$SignosVitales)
	{
		

		try {
			$milisegundos = round(microtime(true) / 1000);

		$nombre='EXP-'.date('Y').'-'.$milisegundos;
		$conn= self::connect();
		$sql=$conn->prepare("INSERT INTO public.tb_expediente(Nombre,Id_Responsable,FechaCreacion,UsuarioCreacion,Estado) VALUES(:nombre,:responsable,NOW(),:creado,:estado)");
		$sql->execute(["nombre"=>$nombre,"responsable"=>$id_usuario,"creado"=>$id_usuario,"estado"=>1]);

		
		$actualizar=$conn->prepare("UPDATE public.tb_signosVitales set estado=3 where pid=:SignosVitales");
		$actualizar->execute(["SignosVitales"=>$SignosVitales]);

		($actualizar)? true:false;
		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function mostrarInfo($id)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT pid,et.usuario_emisor,sv.estado,et.fecha_traslado,sv.motivo,sv.observacion,tp.pnombre,tp.papellido,tp.pidenticacion from public.tb_Expediente_traslado et
    INNER JOIN public.tb_signosvitales sv
    ON sv.pid=et.pid_signosviatles
    INNER JOIN public.tb_persona tp
    ON tp.pidpersona=CAST(sv.tb_persona AS INTEGER)
    where et.responsable=:responsable and sv.estado=2");
		$sql->execute(["responsable"=>$id]);
		
	$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$d = array_map('recorrer', $filas);
		return $d;

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}







}

function recorrer($array){
	$array['fecha_traslado']=date('d/m/Y', strtotime($array['fecha_traslado']));
	$array['hora']=date('h:m: a', strtotime($array['fecha_traslado']));
return $array;
}
 ?>

