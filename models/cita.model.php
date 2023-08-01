<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfiEmpleados();
		public function Busqueda($codigoEmpleado,$selectBusqueda,$identificacion,$param);
		public function guardarPreclinica($identificacion,$CodigoEmpleado,$Nombre,$Apellido,$FechaNacimiento,$txtEdad,$txtSexo,$EstadoCivil,$txtOcupacion,$Dependencia,$txtReligion,$txtRaza,$txtTipoSanguineo,$txtResidencia,$txtTelefono);
		public function guardarSignosVitales($registroGuardado,$PA,$FC,$pulso,$FR,$temperatura,$Sp02,$Glu,$peso,$talla,$imc,$motivo,$txtObservacion,$fechaInicio,$TipodeAtencion);
		public function GetListaEstadoCivil();
		public function GetListaSangre();
		public function mostrarxTipodeAtencion();
	}
class clinica extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
	} 
	public function mostrarxTipodeAtencion()
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_Catalogos tb where tb.ctipo='Tipo-Atencion' and tb.estado=true");
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function GetListaEstadoCivil()
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_Catalogos tb where tb.ctipo='Estado-Civil' and tb.estado=true");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		return $filas;
	}
	public function GetListaSangre()
	{
		$conn= self::connect();
		$sql=$conn->prepare("select * from public.tb_Catalogos tb where tb.ctipo='Tipo-Sangre' and tb.estado=true");
		$sql->execute();
		$filas=$sql->fetchAll(PDO::FETCH_ASSOC);

		return $filas;
	}
	public function guardarSignosVitales($registroGuardado,$PA,$FC,$pulso,$FR,$temperatura,$Sp02,$Glu,$peso,$talla,$imc,$motivo,$txtObservacion,$fechaInicio,$TipodeAtencion){
		$conn= self::connect();
		$fin=time();
		$insert=$conn->prepare("INSERT INTO public.tb_signosVitales(tb_persona,presionarterial,frecuenciacardiaca,pulso,frecuenciarespiratoria,terperaturacorporal,saturacionoxigeno,glucosa,peso,talla,imc,motivo,estado,observacion,fechacreacion,fecha_inicio,fecha_fin,TipodeAtencion)
		 VALUES(:persona,:PA,:FC,:pulso,:FR,:temperatura,:Sp02,:glu,:peso,:talla,:imc,:motivo,:estado,:observacion,now(),:fecha_inicio,:fin,:TipodeAtencion)");

		$insert->execute(["persona"=>$registroGuardado,
		"PA"=>$PA,
		"FC"=>$FC,
		"pulso"=>$pulso,
		"FR"=>$FR,
		"temperatura"=>$temperatura,
		"Sp02"=>$Sp02,
		"glu"=>$Glu,
		"peso"=>$peso,
		"talla"=>$talla,
		"imc"=>$imc,
		"motivo"=>$motivo,
		"estado"=>1,
		"observacion"=>$txtObservacion,
		"fecha_inicio"=>$fechaInicio,
		"fin"=>$fin,
		"TipodeAtencion"=>$TipodeAtencion]);

		return ($insert)? true: false;

	}
	public function guardarPreclinica($identificacion,$CodigoEmpleado,$Nombre,$Apellido,$FechaNacimiento,$txtEdad,$txtSexo,$EstadoCivil,$txtOcupacion,$Dependencia,$txtReligion,$txtRaza,$txtTipoSanguineo,$txtResidencia,$txtTelefono)
	{
		try {
			// |||||||||||||pfechacreacion|pusuariocreacion|pultimamdoficacion|usuariomodificacion|
			$conn= self::connect();
			$sql=$conn->prepare("INSERT INTO public.tb_persona (pidenticacion,pcodigo,pnombre,papellido,pfechanacimiento,pedad,psexo
			,pestadocivil,pocupacion,pdependencia,preligion,prazan,ptiposanguineo,presidenciaactual,pfechacreacion,telefono) VALUES(:identidad,:codigo,:nombre,:apellido,:fechaNacimiento,:edad,:sexo,:estadoCivil,:ocupacion,:dependencia,:religion,:prazan,:ptiposanguineo,:presidenciaactual,now(),:telefono)");
			$sql->execute(["identidad"=>$identificacion,
			"codigo"=>$CodigoEmpleado,
			"nombre"=>$Nombre,
			"apellido"=>$Apellido,
			"fechaNacimiento"=>$FechaNacimiento,
			"edad"=>$txtEdad,
			"sexo"=>$txtSexo,
			"estadoCivil"=>$EstadoCivil,
			"ocupacion"=>$txtOcupacion,
			"dependencia"=>$Dependencia,
			"religion"=>$txtReligion,
			"prazan"=>$txtRaza,
			"ptiposanguineo"=>$txtTipoSanguineo,
			"telefono"=>$txtTelefono,
			"presidenciaactual"=>$txtResidencia]);
			if ($sql) {
				$consultadb=$conn->prepare("SELECT MAX(tp.pidpersona) as num FROM public.tb_persona tp");
				$consultadb->execute();
				$filas=$consultadb->fetchAll();
				
				$bool=$filas[0]['num'];
			}else{
				$bool=FALSE;
			}
			return $bool;

		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function Busqueda($codigoEmpleado,$selectBusqueda,$identificacion,$param){
		switch ($selectBusqueda) {
			case 'Codigo':
				try {

					$conn= self::SQLServer();
					$sql=mssql_query("SELECT cempno,cfname,clname,cstatus,cfedid,py.cdeptno,nmonthpay,dbirth,pdt.cdeptname,job.cDesc,py.csex from prempy py
					inner join dbo.prdept pdt on pdt.cdeptno = py.cdeptno  
					inner join dbo.HRJobs job on job.cJobTitlNO = py.cjobtitle 
					where py.cempno='$codigoEmpleado'");
					
					while($fila=mssql_fetch_array($sql)){
						$fecha=date('Y-m-d', strtotime($fila['dbirth']));
					  $fila[1]=utf8_encode($fila[1]);
					  $fila['cfname']=utf8_encode($fila['cfname']);
					  $fila[2]=utf8_encode($fila[2]);
					  $fila['clname']=utf8_encode($fila['clname']);
					  $fila['fecha']=$fecha;
					  $fila['cdeptname']=utf8_encode($fila['cdeptname']);
					  $fila[8]=utf8_encode($fila[8]);
					  $fila['cDesc']=utf8_encode($fila['cDesc']);
					  $fila[9]=utf8_encode($fila[9]);
					  $date1 = new DateTime(date('Y-m-d', strtotime($fila['dbirth'])));
					  $date2 = new DateTime();
					  $diff = $date1->diff($date2);
					  $fila['edad']= $diff->y."";

					  if($fila['cstatus']=='A'){
						$fila['cstatus']=1;
					  }else if ($fila['cstatus']=='I'){
						$fila['cstatus']=2;
					  }else if ($fila['cstatus']=='T'){
						$fila['cstatus']=3;
					  }

					  
					  $arr[]=$fila;
					}
					return $arr;
				
			  
			  
			   
					  
					  } catch (PDOException $exception) {
						  exit($exception->getMessage());
					  }
				break;
			case 'identidad':
				try {

					$conn= self::SQLServer();
					$sql=mssql_query("SELECT cempno,cfname,clname,cstatus,cfedid,py.cdeptno,nmonthpay,dbirth,pdt.cdeptname,job.cDesc,py.csex from prempy py
					inner join dbo.prdept pdt on pdt.cdeptno = py.cdeptno  
					inner join dbo.HRJobs job on job.cJobTitlNO = py.cjobtitle 
					where py.cfedid='$identificacion'");
			  
					while($fila=mssql_fetch_array($sql)){
						
						$fecha=date('Y-m-d', strtotime($fila['dbirth']));
					  $fila[1]=utf8_encode($fila[1]);
					  $fila['cfname']=utf8_encode($fila['cfname']);
					  $fila[2]=utf8_encode($fila[2]);
					  $fila['clname']=utf8_encode($fila['clname']);
					  $fila['fecha']=$fecha;
					  $fila['cdeptname']=utf8_encode($fila['cdeptname']);
					  $fila[8]=utf8_encode($fila[8]);
					  $fila['cDesc']=utf8_encode($fila['cDesc']);
					  $fila[9]=utf8_encode($fila[9]);
					  $date1 = new DateTime(date('Y-m-d', strtotime($fila['dbirth'])));
					  $date2 = new DateTime();
					  $diff = $date1->diff($date2);
					  $fila['edad']= $diff->y."";

					  if($fila['cstatus']=='A'){
						$fila['cstatus']=1;
					  }else if ($fila['cstatus']=='I'){
						$fila['cstatus']=2;
					  }else if ($fila['cstatus']=='T'){
						$fila['cstatus']=3;
					  }

					
					  $arr[]=$fila;
					}
					return $arr;

					  } catch (PDOException $exception) {
						  exit($exception->getMessage());
					  }
				break;
				case 'nombre':
					try {
	
						$conn= self::SQLServer();
						$sql=mssql_query("SELECT cempno,cfname,clname,cstatus,cfedid,py.cdeptno,nmonthpay,dbirth,pdt.cdeptname,job.cDesc,py.csex   from prempy py
						inner join dbo.prdept pdt on pdt.cdeptno = py.cdeptno  
						inner join dbo.HRJobs job on job.cJobTitlNO = py.cjobtitle 
						where py.cempno='$param'");
				  
						while($fila=mssql_fetch_array($sql)){
							
							$fecha=date('Y-m-d', strtotime($fila['dbirth']));
					  $fila[1]=utf8_encode($fila[1]);
					  $fila['cfname']=utf8_encode($fila['cfname']);
					  $fila[2]=utf8_encode($fila[2]);
					  $fila['clname']=utf8_encode($fila['clname']);
					  $fila['fecha']=$fecha;
					  $fila['cdeptname']=utf8_encode($fila['cdeptname']);
					  $fila[8]=utf8_encode($fila[8]);
					  $fila['cDesc']=utf8_encode($fila['cDesc']);
					  $fila[9]=utf8_encode($fila[9]);
					  $date1 = new DateTime(date('Y-m-d', strtotime($fila['dbirth'])));
					  $date2 = new DateTime();
					  $diff = $date1->diff($date2);
					  $fila['edad']= $diff->y."";

					  if($fila['cstatus']=='A'){
						$fila['cstatus']=1;
					  }else if ($fila['cstatus']=='I'){
						$fila['cstatus']=2;
					  }else if ($fila['cstatus']=='T'){
						$fila['cstatus']=3;
					  }

					  
					  $arr[]=$fila;
						}
						return $arr;
					
				  
				  
				   
						  
						  } catch (PDOException $exception) {
							  exit($exception->getMessage());
						  }
					break;
			default:
				# code...
				break;
		}
		
	}

	public function mostrarInfiEmpleados(){
		try {

      $conn= self::SQLServer();
      $sql=mssql_query("SELECT cempno,cfname,clname,cstatus from prempy");

      while($fila=mssql_fetch_array($sql)){
		  
		$fila[1]=utf8_encode(trim($fila[1]));
		$fila['cfname']=utf8_encode(trim($fila['cfname']));
		$fila[2]=utf8_encode(trim($fila[2]));
		$fila['clname']=utf8_encode(trim($fila['clname']));
        $arr[]=$fila;
      }
      return $arr;
  


 
		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}



}
 ?>

