<?php
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL); 
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfiEmpleados();
		public function Busqueda($id);
		public function UpdateEmpleado($identificacion,$CodigoEmpleado,$Nombre,$Apellido,$FechaNacimiento,$txtEdad,$txtSexo,$EstadoCivil,$txtOcupacion,$Dependencia,$txtReligion,$txtRaza,$txtTipoSanguineo,$txtResidencia,$txtTelefono);
		public function guardarSignosVitales($registroGuardado,$PA,$FC,$pulso,$FR,$temperatura,$Sp02,$Glu,$peso,$talla,$imc,$motivo,$txtObservacion,$fechaInicio,$TipodeAtencion);
		public function GetListaEstadoCivil();
		public function GetListaSangre();
		public function mostrarxTipodeAtencion();
		public function MostrarEmpleadoExistente($identidad);
	}
class clinica extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
	} 
	public function MostrarEmpleadoExistente($identidad)
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT * from tb_persona tp where tp.pidenticacion =:identidad and tp.habilitado=:habilitado");
		$sql->execute(["identidad"=>trim($identidad),"habilitado"=>true]);
		return ($sql->fetchAll()) ? true:false;
		
	}
	public function mostrarxTipodeAtencion()
	{
		$conn= self::connect();
		$sql=$conn->prepare("SELECT * from public.tb_Catalogos tb where tb.ctipo='Tipo-Atencion' and tb.estado=true order by tb.cnombre");
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
		try {
			
			$conn= self::connect();
		$fin=time();
		$insert=$conn->prepare("INSERT INTO public.tb_signosVitales(tb_persona,presionarterial,frecuenciacardiaca,pulso,frecuenciarespiratoria,terperaturacorporal,saturacionoxigeno,glucosa,peso,talla,imc,motivo,estado,observacion,fechacreacion,fecha_inicio,fecha_fin,TipodeAtencion,anulado,esnuevo)
		 VALUES(:persona,:PA,:FC,:pulso,:FR,:temperatura,:Sp02,:glu,:peso,:talla,:imc,:motivo,:estado,:observacion,now(),:fecha_inicio,:fin,:TipodeAtencion,:anulado,:esnuevo)");

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
		"TipodeAtencion"=>$TipodeAtencion,
		"anulado"=>1,
		"esnuevo"=>0]);

		return ($insert)? true: false;

return $fechaInicio;
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
		

	}
	public function UpdateEmpleado($identificacion,$CodigoEmpleado,$Nombre,$Apellido,$FechaNacimiento,$txtEdad,$txtSexo,$EstadoCivil,$txtOcupacion,$Dependencia,$txtReligion,$txtRaza,$txtTipoSanguineo,$txtResidencia,$txtTelefono)
	{
		try {
			// |||||||||||||pfechacreacion|pusuariocreacion|pultimamdoficacion|usuariomodificacion|
			$conn= self::connect();
			$sql=$conn->prepare("UPDATE public.tb_persona  set pcodigo=:codigo,pnombre=:nombre,papellido=:apellido,pfechanacimiento=:fechaNacimiento,pedad=:edad,psexo=:sexo,pestadocivil=:estadoCivil,pocupacion=:ocupacion,
			pdependencia=:dependencia,preligion=:religion,prazan=:prazan,ptiposanguineo=:ptiposanguineo,presidenciaactual=:presidenciaactual,pultimamdoficacion=NOW(),telefono=:telefono where
			pidenticacion =:identidad and habilitado=:habilitado");
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
			"presidenciaactual"=>$txtResidencia,
			"habilitado"=>true]);
			return ($sql)? true: false;

		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function Busqueda($id){
		try {

        $conn= self::connect();
		$sql=$conn->prepare("SELECT * from tb_persona tp where tp.pidenticacion=:identidad and habilitado=true");
		$sql->execute(["identidad"=>$id]);
        $filas=$sql->fetchAll(PDO::FETCH_ASSOC);
        $recorrigo=array_map('recorrer',$filas);
      
		return $recorrigo;
              } catch (PDOException $exception) {
                  exit($exception->getMessage());
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



function recorrer($array){
   $Conexion= new Conexion();
$id=$array['pidpersona'];
 $conn= $Conexion->connect();
 
		$sql=$conn->prepare("SELECT * from tb_persona p 
        inner join tb_catalogos c
        on CAST(p.pestadocivil  AS INTEGER) =c.cid where p.pidpersona =:id");
		$sql->execute(["id"=>$id]);
        $filas=$sql->fetchAll();
        
        $array['estadoCivil']=$filas[0]['cnombre'];
        $array['idestadoCivil']=$filas[0]['cid'];
        $sqlSanguineo=$conn->prepare("SELECT * from tb_persona p
        inner join tb_catalogos c
        on CAST(p.ptiposanguineo  AS INTEGER) =c.cid 
        where p.pidpersona =:id");
		$sqlSanguineo->execute(["id"=>$id]);
        $row=$sqlSanguineo->fetchAll();
        
        $array['Tiposanguieno']=$row[0]['cnombre'];
		$array['idTipoSanguineo']=$row[0]['cid'];
		if ( $array['Tiposanguieno']=="") {
			$array['Tiposanguieno']="Ingrese Opcion";
			$array['idTipoSanguineo']="";
		}
    $array['pfechanacimiento']=date('Y-m-d',strtotime( $array['pfechanacimiento']));

    return $array;
}
 ?>

