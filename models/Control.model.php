<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface clinica
	{
		public function FinExpediente($id);
		public function mostrarInfo($id);
		public function BuscarPreclinicas($id);
		public function Detallepreclinica($preclinica);
		public function GuardarAntecedentesPersonales($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);
		public function MostrarAntecedentes($id,$unico);
		public function ActualizarAntecedente($id,$txtApp,$txtAF,$txtAHGT,$txtAlergias,$txtVacunas,$txtAE,$txtHabitosToxicos,$habitosnoToxicos,$txtHabitosSaludables,$AntGo);
		public function AnularAntecedente($idAntecedente);
		public function LLenarExamenFisico($id,$unico);
		public function GuardarExamenFisico($fisicos);
		public function ActualizarFormExamenesFisicos($fisicos);
		public function EliminarExamenFisico($id);
		public function LLenarExamenLaboratorial($id);
		public function GuardarExamenLaboratorio($array);
		public function AnularLab($id);
		public function MostrarDetalleLaboratorio($id);
		public function UpdateLaboratorio($array);
		public function GuardarDiagnostico($descripcion,$id);
		public function MotrarDiagnosticoActual($GlobalExpediente);
		public function UpdateTratamiento($tratamiento,$id);
		public function MotrarTratamiento($expediente);
		public function GuardarIncapacidad($FechaFin,$FechaInicio,$txtincapacidad,$id);
	}
class Recibir extends Conexion implements clinica
{
	function __construct(){
		$this->msg='';
	} 
	public function DiasHabiles($fecha_inicial,$fecha_final)
	{
		$fecha1 = strtotime($fecha_inicial); 
		$fecha2 = strtotime($fecha_final); 
		$i=0;
		for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
		   
			
			if(date('D',$fecha1)=='Sat' || date('D',$fecha1)=='Sun' ){
				
			}else{
				$i++;
			}
		  
		} 
	return $i;
	}
	public function GuardarIncapacidad($FechaFin,$FechaInicio,$txtincapacidad,$id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_expediente set incapacidad=:incapacidad,incapacidad_inicio=:inicio,incapacidad_fin=:fin,cant_dias_incapacidad=:dias where id_expediente=:id");
		$sql->execute(
			[
				"incapacidad"=>$txtincapacidad,
				"inicio"=>$FechaInicio,
				"fin"=>$FechaFin,
				"dias"=>$this->DiasHabiles($FechaInicio,$FechaFin),
				"id"=>$id
			]);
			return ($sql)? true:false;

		//return $this->DiasHabiles($FechaInicio,$FechaFin);
		
	}
	public function MotrarTratamiento($expediente)
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT tratamiento from tb_expediente te where te.id_expediente =:id");
		$sql->execute(
			[
				"id"=>$expediente
			]);
			$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
			return $filas;
	}
	public function UpdateTratamiento($tratamiento,$id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_expediente set tratamiento=:Tratamiento where id_expediente=:id");
		$sql->execute(
			[
				"Tratamiento"=>$tratamiento,
				"id"=>$id
			]);
			return ($sql)? true:false;
	}
	public function MotrarDiagnosticoActual($GlobalExpediente)
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT diagnostico from tb_expediente te where te.id_expediente =:id");
		$sql->execute(
			[
				"id"=>$GlobalExpediente
			]);
			$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
			return $filas;
	}
	public function GuardarDiagnostico($descripcion,$id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_expediente set diagnostico=:descripcion where id_expediente=:id");
		$sql->execute(
			[
				"descripcion"=>$descripcion,
				"id"=>$id
			]);
			return ($sql)? true:false;
	}
	public function FinExpediente($id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_Expediente set finalizado=:tiempo where id_expediente=:id");
		$sql->execute(
			[
				"tiempo"=>time(),
				"id"=>$id
			]);
			return ($sql)? true:false;
	}
	public function UpdateLaboratorio($array)
	{
		$conn= self::connect();
		
		$sql=$conn->prepare("UPDATE public.tb_expediente_examen_laboratorial set hemograma=:hemograma,
		quimica_general=:quiimca,ego=:rgo,egh=:egh,covid=:covid,otros=:otros where id_laboratorial=:id");
		
		
			$sql->execute(
			[
				"id"=>$array[0],
				"hemograma"=>$array[1],
				"quiimca"=>$array[2],
				"rgo"=>$array[3],
				"egh"=>$array[4],
				"covid"=>$array[5],
				"otros"=>$array[6]

			]);

			return ($sql)? true:false;
	}
	public function MostrarDetalleLaboratorio($id)
	{
		$conn= self::connect();
	
	
			$sql=$conn->prepare("SELECT * from public.tb_Expediente_Examen_laboratorial where id_laboratorial=:id");
		
		
			$sql->execute(["id"=>$id]);
		
			$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;
		
	}
	public function AnularLab($id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_Expediente_Examen_laboratorial set estado=false WHERE id_laboratorial=:id ");
		$sql->execute(["id"=>$id]);
		return ($sql)? true:false;

	}
	public function GuardarExamenLaboratorio($array)
	{
		$conn= self::connect();
		$sql=$conn->prepare("INSERT INTO public.tb_Expediente_Examen_laboratorial(id_expediente,hemograma,quimica_general,ego,egh,covid,otros,fechacreacion,usuariocreacion,estado) 
		VALUES(:expediente,:hemograma,:quimica_general,:ego,:egh,:covid,:otros,NOW(),:usuariocreacion,true)");
		$sql->execute(
			[
				"expediente"=>$array['expediente'],
				"hemograma"=>$array['txtHemograma'],
				"quimica_general"=>$array['txtQuimica'],
				"ego"=>$array['txtOrina'],
				"egh"=>$array['txtHeses'],
				"covid"=>$array['txtCovid'],
				"otros"=>$array['txtOtros'],
				"usuariocreacion"=>$array['usuario']
			]
		);
		return ($sql)? true:false;


	}
	public function LLenarExamenLaboratorial($id)
	{
			$conn= self::connect();
	
			$sql=$conn->prepare("SELECT * FROM public.tb_Expediente_Examen_laboratorial where id_expediente=:id and estado=true");
		
		
			$sql->execute(["id"=>$id]);
		
			$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;
	}
	public function EliminarExamenFisico($id)
	{
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_Expediente_Examen_Fisico set estado=false WHERE id_examen=:id ");
		$sql->execute(["id"=>$id]);
		return ($sql)? true:false;

	}
	public function ActualizarFormExamenesFisicos($fisicos)
	{
	
		$conn= self::connect();
		$sql=$conn->prepare("UPDATE public.tb_Expediente_Examen_Fisico set aparienciageneral=:aparienciageneral,cabeza=:cabeza,cuello=:cuello,torax=:torax,corazon=:corazon,pulmones=:pulmones,mamas=:mamas,abdomen=:abdomen,genitales=:genitales,osteomuscular=:osteomuscular,exremidades=:exremidades,piel=:piel,neurologicos=:neurologicos WHERE id_examen=:id ");

		$sql->execute([
			"aparienciageneral"=>$fisicos['txtPariencia'],
			"cabeza"=>$fisicos['txtCabeza'],
			"cuello"=>$fisicos['txtCuello'],
			"torax"=>$fisicos['txtTorax'],
			"corazon"=>$fisicos['txtCorazon'],
			"pulmones"=>$fisicos['txtPulmones'],
			"mamas"=>$fisicos['txtmamas'],
			"abdomen"=>$fisicos['txtabdomen'],
			"genitales"=>$fisicos['txtGenilates'],
			"osteomuscular"=>$fisicos['txtOsteomuscular'],
			"exremidades"=>$fisicos['txtExtremidades'],
			"piel"=>$fisicos['txtPielFaneas'],
			"neurologicos"=>$fisicos['txtNeurologico'],
			"id"=>$fisicos['examenfisico']
			]);
		

		return ($sql)? true:false;
	}

	public function GuardarExamenFisico($fisicos)
	{
		try {
			$conn= self::connect();

			$sql=$conn->prepare("INSERT INTO public.tb_Expediente_Examen_Fisico(id_expediente,aparienciageneral,cabeza,cuello,torax,corazon,pulmones,mamas,abdomen,genitales,osteomuscular,exremidades,piel,neurologicos,fechacreacion,estado)
			VALUES(:expediente,:apariencia,:cabeza,:cuello,:torax,:corazon,:pulmones,:mamas,:abdomen,:genitales,:osteomuscular,:extremidades,:piel,:neurologicos,NOW(),:estado) ");

			$sql->execute(["expediente"=>$fisicos['expediente'],"apariencia"=>$fisicos['txtPariencia'],"cabeza"=>$fisicos['txtCabeza'],"cuello"=>$fisicos['txtCuello'],"torax"=>$fisicos['txtTorax'],"corazon"=>$fisicos['txtCorazon'],"pulmones"=>$fisicos['txtPulmones'],"mamas"=>$fisicos['txtmamas'],"abdomen"=>$fisicos['txtabdomen'],"genitales"=>$fisicos['txtGenilates'],"osteomuscular"=>$fisicos['txtOsteomuscular'],"extremidades"=>$fisicos['txtExtremidades'],"piel"=>$fisicos['txtPielFaneas'],"neurologicos"=>$fisicos['txtNeurologico'],"estado"=>true]);
			return ($sql)? true:false;
		}catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function LLenarExamenFisico($id,$unico)
	{
		try{
			$conn= self::connect();

				if ($unico==true) {
					$sql=$conn->prepare("SELECT id_examen, id_expediente, aparienciageneral, cabeza, cuello, torax, corazon, pulmones, mamas, abdomen, genitales, osteomuscular, exremidades, piel,neurologicos,to_char(fechacreacion,'DD/MM/YYYY') AS fechacreacion, usuariocreacion,estado FROM public.tb_Expediente_Examen_Fisico where id_expediente=:id and estado=true ORDER BY id_examen desc");
				}else{
					$sql=$conn->prepare("SELECT id_examen, id_expediente, aparienciageneral, cabeza, cuello, torax, corazon, pulmones, mamas, abdomen, genitales, osteomuscular, exremidades, piel,neurologicos,to_char(fechacreacion,'DD/MM/YYYY') AS fechacreacion, usuariocreacion,estado FROM public.tb_Expediente_Examen_Fisico where id_examen=:id");
				}
					
				
				
			
			
			$sql->execute(["id"=>$id]);
			
			$filas=$sql->fetchAll(PDO::FETCH_ASSOC);
		return $filas;
	
			}catch (PDOException $exception) {
				exit($exception->getMessage());
			}
	}
	public function AnularAntecedente($idAntecedente)
	{
		try{
			$conn= self::connect();
			
				$sql=$conn->prepare("UPDATE public.tb_expediente_antecedentes SET estado=false WHERE id_antecedente=:id");
			
			
			$sql->execute(["id"=>$idAntecedente]);
			
			return ($sql)? true:false;
	
			}catch (PDOException $exception) {
				exit($exception->getMessage());
			}
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
			$sql=$conn->prepare("SELECT id_antecedente,app,af,ahqt,alergias,vacunas,ae,habitos_toxicos,habitos_no_toxicos,habitos_saludables,antecedentes_go,fechacreacion,to_char(fechacreacion,'DD/MM/YYYY') AS fecha from public.tb_expediente_antecedentes where id_expediente=:id and estado=true order by fechacreacion desc");
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
			$sql->execute(["id"=>$id,"txtApp"=>$txtApp,"txtAF"=>$txtAF,"txtAHGT"=>$txtAHGT,"txtAlergias"=>$txtAlergias,"txtVacunas"=>$txtVacunas,"txtAE"=>$txtAE,"txtHabitosToxicos"=>$txtHabitosToxicos,"habitosnoToxicos"=>$habitosnoToxicos,"txtHabitosSaludables"=>$txtHabitosSaludables,"AntGo"=>$AntGo]);
			
			
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
		$sql=$conn->prepare("SELECT e.id_expediente,e.nombre,e.id_responsable,e.fechacreacion,e.usuariocreacion,e.estado,e.sp,e.hea,e.fog,u.nombrecompleto,tp.pnombre,tp.papellido,e.finalizado  from public.tb_expediente e
		inner join  public.usuarios u 
		on e.id_responsable =u.id_usuario 
		inner join public.tb_expediente_preclinicas tep 
		on tep.id_expediente = e.id_expediente 
		inner join public.tb_signosvitales ts 
		on ts.pid =tep.pid_signos 
		inner join public.tb_persona tp 
		on tp.pidpersona =CAST (ts.tb_persona AS INTEGER)
		where e.id_responsable  =:id");
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

