<?php
		ini_set("memory_limit",-1);
    require_once("libs/dao.php");
	date_default_timezone_set('America/Tegucigalpa');
	interface cita
	{
		public function mostrarInfiEmpleados();
		public function Busqueda($codigoEmpleado,$selectBusqueda,$identificacion,$param);
	}
class clinica extends Conexion implements cita
{
	function __construct(){
        $this->msg='';
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
					$sql=mssql_query("SELECT cempno,cfname,clname,cstatus,cfedid,py.cdeptno,nmonthpay,dbirth,pdt.cdeptname,job.cDesc,py.csex   from prempy py
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
		  
		$fila[1]=utf8_encode($fila[1]);
		$fila['cfname']=utf8_encode($fila['cfname']);
		$fila[2]=utf8_encode($fila[2]);
		$fila['clname']=utf8_encode($fila['clname']);
        $arr[]=$fila;
      }
      return $arr;
  


 
		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}



}
 ?>

