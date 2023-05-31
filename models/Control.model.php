<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function mostrarInfo($id);
		public function BuscarPreclinicas($id);
		public function Detallepreclinica($preclinica);
		public function GuardarAntecedentesPersonales($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);
		public function MostrarAntecedentes($id,$unico);
		public function ActualizarAntecedente($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);

	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
        $this->msg='';
	} 
	public function ActualizarAntecedente($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo){
		try{
			$conn= self::connect();
			
				$sql=$conn->prepare("UPDATE public.tb_expediente_antecedentes
				SET app=:txtApp, af=:txtAF, ahqt=:txtAHGT, alergias=:txtAlergias, vacunas=:txtVacunas, ae=:txtAE, habitos_toxicos=:txtHabitosToxicos, habitos_no_toxicos=:habitosnoToxicos, habitos_saludables=:txtHabitosSaludables, antecedentes_go=:AntGo WHERE id_antecedente=:id");
			
			
			$sql->execute(["id"=>$id,"txtApp"=>$txtApp,"txtAF"=>$txtAF,"txtAHGT"=>$txtAHGT,"txtAlergias"=>$txtAlergias,"txtVacunas"=>$txtVacunas,"txtAE"=>$txtAE,"txtHabitosToxicos"=>$txtHabitosToxicos,"habitosnoToxicos"=>$habitosnoToxicos,"txtHabitosSaludables"=>$txtHabitosSaludables,"AntGo"=>$AntGo]);
			
			return ($sql)? true:false;
	
			}catch (PDOException $exception) {
				exit($exception->getMessage());
			}
	}
	public function MostrarAntecedentes($id,$unico)
	{
		try{
		$conn= self::connect();
		if($unico==true){
			$sql=$conn->prepare("SELECT * from public.tb_expediente_antecedentes tea where tea.id_antecedente =:id");
		}else{
			$sql=$conn->prepare("SELECT * from public.tb_expediente_antecedentes where id_expediente=:id and estado=true");
		}
		
		$sql->execute(["id"=>$id]);
		
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function GuardarAntecedentesPersonales($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo)
	{
		
			try {
				$conn= self::connect();
			$sql=$conn->prepare("INSERT INTO public.tb_expediente_antecedentes(id_expediente,app,af,ahqt,alergias,vacunas,ae,habitos_toxicos,habitos_no_toxicos,habitos_saludables,antecedentes_go,fechacreacion,estado)
			VALUES(:id,:txtApp,:txtAF,:txtAHGT,:txtAlergias,:txtVacunas,:txtAE,:txtHabitosToxicos,:habitosnoToxicos,:txtHabitosSaludables,:AntGo,NOW(),true)");
			$sql->execute(["id"=>$id,"txtApp"=>$txtApp,"txtAF"=>$txtAF,"txtAHGT"=>$txtAHGT,"txtAlergias"=>$txtAlergias,"txtVacunas"=>$txtVacunas,"txtAE"=>$txtAE,"txtHabitosToxicos"=>$id,"habitosnoToxicos"=>$habitosnoToxicos,"txtHabitosSaludables"=>$txtHabitosSaludables,"AntGo"=>$AntGo]);
			
			
			return ($sql)? true:false;
			}catch (PDOException $exception) {
			exit($exception->getMessage());
			}
		
	}
	public function Detallepreclinica($preclinica)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_signosvitales ts 
		inner join public.tb_persona tp 
		on CAST(ts.tb_persona AS INTEGER)  = tp.pidpersona
		and ts.pid=:id");
		$sql->execute(["id"=>$preclinica]);
		
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function BuscarPreclinicas($id)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT ep.id_expediente,ep.pid_signos,tp.pidenticacion,tp.pnombre,tp.papellido,tp.pedad,ts.motivo,ts.observacion,TO_CHAR(ts.fechacreacion, 'DD/MM/YYYY') AS fechacreacion   from public.tb_expediente_preclinicas ep
		INNER JOIN public.tb_expediente e
		ON ep.id_expediente = e.id_expediente
		inner join public.tb_signosvitales ts 
		on ts.pid =ep.pid_signos 
		INNER JOIN public.tb_persona tp 
		ON tp.pidpersona =CAST (ts.tb_persona AS INTEGER)
		and ep.id_expediente=:id");
		$sql->execute(["id"=>$id]);
		
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function mostrarInfo($id)
	{
		try {
			$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_expediente where id_responsable=:id");
		$sql->execute(["id"=>$id]);
		
	$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	$d = array_map('recorrer', $filas);
		return $d;

		

		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		
	}







}

function recorrer($array){
	$array['fechacreacion']=date('d/m/Y', strtotime($array['fechacreacion']));
	$array['hora']=date('h:m: a', strtotime($array['fechacreacion']));
return $array;
}
 ?>

