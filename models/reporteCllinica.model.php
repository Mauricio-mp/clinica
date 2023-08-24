<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($myString,$CbxAnios);
		public function unirconanio($msg);
		public function unirTotales($uniranio);
		
	
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	public function unirTotales($uniranio)
	{

		for ($i=0; $i <count($uniranio) ; $i++) { 
$array2=0;
			
			
			
			$array2 = $this->obtenertotales(date('m',strtotime($uniranio[$i][0])));
			//$array[]=$this->obtenertotales(date('m',strtotime($uniranio[$i][0])));
			//$nuevoarreglo[]=array_merge($array2,$uniranio[$i]);
			for ($j=0; $j <count($array2) ; $j++) { 
				
				
				$arrayName[]= $array2[$j]['cnombre'];
				//$arrayName['contar']=$array2[$j]['count'];
				//$nuevoarreglo[]=array_merge($arrayName,$uniranio[$i]);
				//$nuevoarreglo[] =array_merge((array)$arrayName, (array)$uniranio[$i]);
			}
			$nuevoarreglo[] =array_merge((array)$arrayName, (array)$uniranio[$i]);
		}
		return $nuevoarreglo;
	}
	public function unirconanio($msg)
	{
		for ($i=0; $i <count($msg) ; $i++) { 

			$array=  array('numMes' =>date('m',strtotime($msg[$i]['0'])),'mes'=>convertirFecha(date('m',strtotime($msg[$i][0])) ));
			
			$arreglo[]=array_merge($array,$msg[$i]);



			
			$array2 = array('denis' =>"sasasasas" );

			$nuevoarreglo[]=array_merge($array2,$arreglo[$i]);
			
		}
		return $arreglo;


	}

	public function mostrarInfo($myString,$CbxAnios)
	{
		try {
			$conn= self::connect();

		

		
		$sql=$conn->prepare('SELECT  DATE_TRUNC(\'month\',ts.fechacreacion) from tb_signosvitales ts where 
		extract(month from ts.fechacreacion)in('.$myString.') and extract(year from ts.fechacreacion)=:CbxAnios
		GROUP BY DATE_TRUNC(\'month\',ts.fechacreacion)');
		$sql->execute(["CbxAnios"=>2023]);
		
	$filas=$sql->fetchAll();

	
	return $filas;

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}


	public function obtenertotales($array)
	{
	
	
		$conn= self::connect();
	
			
	
			
			$sql=$conn->prepare("SELECT c.cnombre,count(sv.anulado)  from public.tb_catalogos c
			INNER JOIN public.tb_signosvitales sv
			on sv.tipodeatencion=c.cid
			where c.ctipo ='Tipo-Atencion'
			and extract(year from sv.fechacreacion)=2023 and extract(month from sv.fechacreacion)IN(:mes)
			GROUP BY c.cnombre");
			$sql->execute(["mes"=>$array]);
			
		$filas=$sql->fetchAll();
	
		
		return $filas;
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

