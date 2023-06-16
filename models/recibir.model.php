<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($id);
		public function guardarExpediente($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas);
	
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 

	public function guardarExpediente($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas)
	{
		

		try {
			$milisegundos = round(microtime(true) / 1000);

		$nombre='EXP-'.date('Y').'-'.$milisegundos;
		$conn= self::connect();
		
		$sql=$conn->prepare("INSERT INTO public.tb_expediente(Nombre,Id_Responsable,FechaCreacion,UsuarioCreacion,Estado,sp,hea,fog) VALUES(:nombre,:responsable,NOW(),:creado,:estado,:sp,:hea,:fog)");
		$sql->execute(["nombre"=>$nombre,"responsable"=>$id_usuario,"creado"=>$id_usuario,"estado"=>1,"sp"=>$txtSintomaPrincipal,"hea"=>$txtEnfermadadActual,"fog"=>$txtFuncionesOrganicas]);

		
		$actualizar=$conn->prepare("UPDATE public.tb_signosVitales set estado=3 where pid=:SignosVitales");
		$actualizar->execute(["SignosVitales"=>$SignosVitales]);

		$lastId=$conn->prepare("SELECT MAX(id_expediente) as ultimo FROM public.tb_Expediente where estado=1");
		$lastId->execute();

		$ultimiId=$lastId->fetchAll(PDO::FETCH_ASSOC);
		$idultimo=$ultimiId[0]['ultimo'];
		
		
		$InsertarPreclinica=$conn->prepare("INSERT INTO public.tb_Expediente_Preclinicas(id_expediente,pid_signos,id_persona,fechacreacion,persona_id)VALUES(:expediente,:signos,:persona,NOW(),:idPersona)");
		$InsertarPreclinica->execute(["expediente"=>$idultimo,"signos"=>$SignosVitales,"persona"=>$GlobalIdentidad,"idPersona"=>$id_usuario]);
		

		return ($InsertarPreclinica)? true:false;
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

