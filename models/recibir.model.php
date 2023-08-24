<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($id);
		public function guardarExpediente($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas);
		public function verificarExpediente($GlobalIdentidad);
		public function ExpedienteCreado($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas);
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	public function ExpedienteCreado($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas)
	{
		try {
			$conn= self::connect();
			$sql=$conn->prepare("SELECT te.nombre,te.id_expediente from tb_expediente_preclinicas ep
			inner join tb_expediente te 
			on te.id_expediente =ep.id_expediente  
			where TRIM(ep.id_persona) in(:identidad)");
		$sql->execute(["identidad"=>$GlobalIdentidad]);

		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		$expediente= $filas[0]['id_expediente'];

		$Insert=$conn->prepare("INSERT INTO public.tb_Expediente_Preclinicas(id_expediente,pid_signos,id_persona,fechacreacion,persona_id)VALUES(:expediente,:signos,:persona,NOW(),:idPersona)");
		$Insert->execute(["expediente"=>$expediente,"signos"=>$SignosVitales,"persona"=>$GlobalIdentidad,"idPersona"=>$id_usuario]);

		$actualizar=$conn->prepare("UPDATE public.tb_signosVitales set estado=3 where pid=:SignosVitales");
		$actualizar->execute(["SignosVitales"=>$SignosVitales]);

		$insertgenerales=$conn->prepare("INSERT INTO public.tb_expediente_datos_generales (id_expediente,pid_signos,sintoma_principal,historial_enfer,fun_organ_gen,fechacreacion,usuariocreacion,estado)
		values(:expediente,:signos,:sp,:hea,:fog,NOW(),:idPersona,true)");
		$insertgenerales->execute(["expediente"=>$expediente,"signos"=>$SignosVitales,"sp"=>$txtSintomaPrincipal,"hea"=>$txtEnfermadadActual,"fog"=>$txtFuncionesOrganicas,"idPersona"=>$id_usuario]);

			return ($insertgenerales) ? true:false;
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function verificarExpediente($GlobalIdentidad)
	{
		try {
			$conn= self::connect();
		
		$sql=$conn->prepare("SELECT * from tb_expediente_preclinicas ep where TRIM(ep.id_persona) in(:identidad)");
		$sql->execute(["identidad"=>$GlobalIdentidad]);

		$filas=$sql->rowCount();
		if ($sql->rowCount()==0) {
			return false;
		}else{
			return true;
		}
		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function guardarExpediente($GlobalIdentidad,$id_usuario,$SignosVitales,$txtSintomaPrincipal,$txtEnfermadadActual,$txtFuncionesOrganicas)
	{
		

		try {
			$milisegundos = round(microtime(true) / 1000);

		$nombre='EXP-'.date('Y').'-'.$milisegundos;
		$conn= self::connect();
		
		$sql=$conn->prepare("INSERT INTO public.tb_expediente(Nombre,Id_Responsable,FechaCreacion,UsuarioCreacion,Estado) VALUES(:nombre,:responsable,NOW(),:creado,:estado)");
		$sql->execute(["nombre"=>$nombre,"responsable"=>$id_usuario,"creado"=>$id_usuario,"estado"=>1]);

		
		$actualizar=$conn->prepare("UPDATE public.tb_signosVitales set estado=3 where pid=:SignosVitales");
		$actualizar->execute(["SignosVitales"=>$SignosVitales]);

		$lastId=$conn->prepare("SELECT MAX(id_expediente) as ultimo FROM public.tb_Expediente where estado=1");
		$lastId->execute();

		$ultimiId=$lastId->fetchAll(PDO::FETCH_ASSOC);
		$idultimo=$ultimiId[0]['ultimo'];
		
		$insertgenerales=$conn->prepare("INSERT INTO public.tb_expediente_datos_generales (id_expediente,pid_signos,sintoma_principal,historial_enfer,fun_organ_gen,fechacreacion,usuariocreacion,estado)
		values(:expediente,:signos,:sp,:hea,:fog,NOW(),:idPersona,true)");
		$insertgenerales->execute(["expediente"=>$idultimo,"signos"=>$SignosVitales,"sp"=>$txtSintomaPrincipal,"hea"=>$txtEnfermadadActual,"fog"=>$txtFuncionesOrganicas,"idPersona"=>$id_usuario]);
		
		$InsertarPreclinica=$conn->prepare("INSERT INTO public.tb_Expediente_Preclinicas(id_expediente,pid_signos,id_persona,fechacreacion,persona_id)VALUES(:expediente,:signos,:persona,NOW(),:idPersona)");
		$InsertarPreclinica->execute(["expediente"=>$idultimo,"signos"=>$SignosVitales,"persona"=>$GlobalIdentidad,"idPersona"=>$id_usuario]);

		$GetIdentidad=$conn->prepare("SELECT * from tb_persona tp where tp.habilitado=true and trim(tp.pidenticacion)=:iden");
		$GetIdentidad->execute(["iden"=>$GlobalIdentidad]);
		$getId=$GetIdentidad->fetchAll(PDO::FETCH_ASSOC);
		$idempleado=$getId[0]['pidpersona'];

		$Insertrelacion=$conn->prepare("INSERT into tb_Expediente_Empleado(id_Expediente,Id_persona,FechaCreacion)values(:empediente,:persona,NOW())");
		$Insertrelacion->execute(["empediente"=>$idultimo,"persona"=>$idempleado]);
		return ($Insertrelacion)? true:false;
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
	$array['fecha_de_traslado']=date('d/m/Y', strtotime($array['fecha_traslado']));
	$array['hora']=date('h:i: a', strtotime($array['fecha_traslado']));
return $array;
}
 ?>

