<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		function mostrarInfo($anio,$mes);
		public function mostrarAnio();
	
	}
class Consulta extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	public function mostrarAnio() {
		$i=date('Y');
		$j=0;
		for ($i; $i >=2023 ; $i--) { 
			$anio[$j]['aaa']=$i;
			$j++;
		}
		return $anio;
	}
    function recorrer($fila)  {
        if($fila['finalizado']==''){
         
            $fila['tiempo']=date('h:i A',$fila['fecha_inicio'])." - ".date('h:i A',$fila['fecha_fin']);
        }else{
		
            $fila['tiempo']=date('h:i A',$fila['fecha_inicio'])." - ".date('h:i A',$fila['finalizado']);
        }
		
        return $fila;
    }
	
function mostrarInfo($anio,$mes) {
try {
    $conn= self::connect();
    $sql=$conn->prepare("SELECT ts.fecha_fin,ts.fecha_inicio,ts.finalizado,tp.pcodigo,tp.pidenticacion,tp.pnombre,tp.papellido,ts.fechacreacion,ts.observacion as descr,tp.pocupacion,tp.pdependencia,tp.telefono,tc.cnombre from tb_signosvitales ts 
    inner join tb_persona tp 
    on tp.pidpersona =CAST (ts.tb_persona AS INTEGER)  
    inner join tb_catalogos tc 
    on tc.cid =ts.tipodeatencion 
    where extract('year' from ts.fechacreacion) IN(:anio) and extract('month' from ts.fechacreacion) IN($mes)");
		$sql->execute(["anio"=>$anio]);
		
	$filas=$sql->fetchAll();

	$row=array_map('Consulta::recorrer',$filas);
	return $row;

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

