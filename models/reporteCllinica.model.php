<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		
		public function Mostrardatos($inicio,$fin);
		public function recorrigo($array);
	
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	function recorrigo($array)  {
		//$array['tiempo']=$array['fecha_inicio']."hasta".$array['finalizado'];
		$array['ini']=date('h:i A',$array['fecha_inicio']);
		$array['fin']=date('h:i A',$array['finalizado']);

		$array['tiempo']=$array['ini']." - ".$array['fin'];

		$array['tiepmpoIncapacidad']=date('d/m/Y',strtotime($array['fechainicio']))." al ".date('d/m/Y',strtotime($array['fechafin']));
		return $array;
	}

	public function Mostrardatos($inicio,$fin) {
		try {
			$conn= self::connect();

		

		
		$sql=$conn->prepare("SELECT tp.pidenticacion,tp.pcodigo,tp.telefono,TO_CHAR(ts.fechacreacion, 'DD/MM/YYYY') AS fechacreacion,tp.pnombre,tp.papellido,ts.anulado,ts.estado,
		ts.fecha_inicio,ts.fecha_fin,ts.finalizado,tp.pdependencia,ts.motivo,
		tei.fechainicio,tei.fechafin,ted.descripcion as diagnostico,tet.descripcion as tratamiento,
		tei.fechainicio,tei.fechafin,tei.dias,tei.descripcion as incapacidad,tei.descripcion as des_incapacidad from tb_signosvitales ts 
		inner join tb_persona tp 
		on tp.pidpersona=CAST (ts.tb_persona AS INTEGER)  
		inner join tb_expediente_incapacidades tei 
		on tei.pid_signos = ts.pid 
		inner join tb_expediente_diagnostico ted 
		on ted.pid_signos =ts.pid 
		inner join tb_expediente_tratamiento tet 
		on tet.id_diagnostico =ted.id_diagnostico 
		where ts.anulado=true
		and ts.fechacreacion between :inicio and :fin");
		$sql->execute(["inicio"=>$inicio,"fin"=>$fin]);
		
	$filas=$sql->fetchAll();

	
	return array_map('Recibir::recorrigo',$filas);

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}
	




}

function recorrer($array){
	
//return convertirFecha($array);
return $array;
}

function convertirFecha($date)
{
	switch ($date) {
		case '1':
			return 'Enero';
			break;
		case '2':
				return 'Febrero';
			break;
			case '3':
				return 'Marzo';
			break;
			case '4':
				return 'Abril';
			break;
			case '5':
				return 'Mayo';
			break;
			case '6':
				return 'Junio';
			break;
			case '7':
				return 'Julio';
			break;
			case '8':
				return 'Agosto';
			break;
			case '9':
			return 'Septiembre';
			break;
			case '10':
				return 'Octubre';
			break;
			case '11':
					return 'Noviembre';
			break;
			case '12':
				return 'Diciembre';
				break;	
		default:
			# code...
			break;
	}
}


 ?>

