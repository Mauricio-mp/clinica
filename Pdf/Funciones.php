<?php
require '../libs/dao.php';

function mostrardatosTrab($mes){
  
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec
  from prmisd a, prempy b where a.cempno=b.cempno and  cpayno='$mes' and cdedcode IN('915') order by tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;

 }

 function vacaciones(){
   $sql=mssql_query("SELECT cPermisoId ,fdesde, fHasta,iDias,cObservaciones from dbo.PR_PermisoH WHERE cPermisoId ='1995 - 19961501-1957-00294'");
   while($var=mssql_fetch_array($sql) ){
    $var['fdesde']=date('d/m/Y',strtotime($var['fdesde']));
    $datos[]=$var;
   }
   return $datos;

 }
function mostrardatosCofinter($mes){
  
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec
  from prmisd a, prempy b where a.cempno=b.cempno and  cpayno='$mes' and cdedcode IN('934') order by tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;

 }

function mostrardatosINJUPEMP($mes){

  
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec
  from prmisd a, prempy b where a.cempno=b.cempno and  cpayno='$mes' and cdedcode IN('930','931','932') order by tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;

 }

function mostrardatosSagrada($mes){
  
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec
  from prmisd a, prempy b where a.cempno=b.cempno and  cpayno='$mes' and cdedcode IN('435') order by tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;

 }
 
function mostrardatosCOMEMP($mes){
  
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec
  from prmisd a, prempy b where a.cempno=b.cempno and  cpayno='$mes' and cdedcode IN('910','911','913') order by tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;

 }
 function mostrardatosDeducciones($myString,$mes){
  $sum=0;
  ConexionSQLserverVAM();
  $sql=mssql_query("SELECT  a.cempno,b.clname, b.cfname,b.ctaxstate, cdeptno,a.cpayno,cfedid, a.cdedcode, a.cdesc, a.ndedamt,cplnid, a.tmodrec,c.ttrndate
  from prmisd a, prempy b, prempd c where a.cempno=b.cempno and a.cdedno=c.cdedno and cpayno='$mes' and a.cdedcode IN($myString) order by a.tmodrec");
   
    while($var=mssql_fetch_array($sql)){
      $sum=$sum+$var['ndedamt'];
      $var['nombre']=utf8_decode(trim($var['cfname']))." ".utf8_decode(trim($var['clname']));
      $var['tlstdate']=date('d/m/Y',strtotime($var['tmodrec']));
      $var['ndedamt']=number_format($var['ndedamt'],2);
      $var['ttrndate']=date('d/m/Y',strtotime($var['ttrndate']));
      $datos['Total']=$sum;
      $var['cdesc']=trim($var['cdesc']);
      $datos[]=$var;
  }
  return $datos;
 }

  function mostrardatosIngreso($myString,$mes){
    

    ConexionSQLserverVAM();
    $cont=1;
    $sum=0;
    $sql=mssql_query("SELECT  b.cempno,b.clname, b.cfname,b.ctaxstate,a.cdeptno,a.cpayno,cfedid, a.cpaycode, a.cref,cplnid,a.nothtax,a.dcheck
    from prmisc a, prempy b where a.cempno=b.cempno and  a.cpayno='$mes' and a.cpaycode IN($myString)");
      while($var=mssql_fetch_array($sql)){
          $var['num']=$cont++;
          $sum=$sum+$var['nothtax'];
        $var['mes']=$mes;
        $nombre=utf8_encode(trim($var['cfname']))." ".utf8_encode(trim($var['clname']));
        $var['nombre']=utf8_decode($nombre);
        $var['dcheck']=date('d/m/Y',strtotime($var['dcheck']));
        $var['nothtax']=number_format($var['nothtax'],2);
        //$var['ndedamt']=number_format($var['ndedamt'],2);
        $datos['Total']=$sum;
        $datos[]=$var;
    } 
    return $datos;

   return 0;
 }
function mostrarDatosEmpleado($identidad){
  ConexionSQLRecursosHumanos();

  $query=mssql_query("SELECT * FROM GN_Persona WHERE cPersonaId='$identidad'");

  if ($dato=mssql_fetch_array($query)) {
    $dato['cNombres']=utf8_encode($dato['cNombres']);
      $dato["cApellidos"]=utf8_encode($dato["cApellidos"]);

      $msg[]=$dato['cNombres'];
      $msg[]=$dato['cApellidos'];
    
  }

  return $msg;
}
function DatosEmpleado($codigo){
  ConexionSQLserverVAM();
  $cont=1;
  $sql=mssql_query("SELECT * FROM prempy WHERE cempno ='$codigo'");
  if($row=mssql_fetch_array($sql)){
      
      $row['num']=$cont++;
      $arr['Nombre']=utf8_encode(trim($row['cfname']))." ".utf8_encode(trim($row['clname']));
      $row['nmonthpay']=number_format($row['nmonthpay'],2);
      $arr['fechainicio']=date('Y-m-d',strtotime($row['dcntrct']));
      $puesto=$row['cjobtitle'];
      $consultarpuesto=mssql_query("SELECT * FROM hrjobs WHERE cJobTitlNO='$puesto'");
      if($fila=mssql_fetch_array($consultarpuesto)){
          $arr['puesto']=$fila['cDesc'];
      }
      
      


  }

  return $arr;
}

function calculo($codigoEmpleado){
  ConexionSQLserverVAM();
 #optener ultima planilla
  $fechaActual=date('Y-m');
  $anio=date('Y');
  $mes=date('m');
  
  $getPlanillaActual=mssql_query("SELECT DISTINCT cpayno FROM prmisc WHERE year(dcheck)='$anio' and month(dcheck)='$mes' and cpayno like '%/$anio%'");
  if(mssql_num_rows($getPlanillaActual)>0){
      $filas=mssql_fetch_array($getPlanillaActual);
      $planilla=$filas['cpayno'];
      $fechaPlanilla=$fechaActual;
      
     
  }else{
      $mesAnterior=date("Y-m",strtotime($fechaActual."- 1 month"));
      $mes2=date("m",strtotime($mesAnterior));
      $aniomesAnterior=date('Y',strtotime($mesAnterior));
      $getPlanillaAnterior=mssql_query("SELECT DISTINCT cpayno FROM prmisc WHERE year(dcheck)='$aniomesAnterior' and month(dcheck)='$-mes2' and cpayno like '%/$aniomesAnterior%'");
      $row=mssql_fetch_array($getPlanillaAnterior);
      $planilla= $row['cpayno'];

      $fechaPlanilla=$mesAnterior;
  
  }
   $planilla= 'DIC/2020';
   $fechaPlanilla='2020-11';
 $arr['planilla']= $planilla;
  
  $arr['fechaPlanilla']= $fechaPlanilla;




 #optener sueldo de ultima planilla
  
  $getSueldoActual=mssql_query("SELECT nothtax FROM prmisc WHERE cpayno='$planilla' and cempno='$codigoEmpleado' and cpaycode='100'");
  $filaSueldo=mssql_fetch_array($getSueldoActual);
  
  $arr['Ultimosueldo']=$filaSueldo['nothtax'];
  $arr['SueldoOrdinario']=number_format($arr['Ultimosueldo'],2);
  #optener planilla de 6 meses 
  $fecha6meses= date("Y-m",strtotime($fechaPlanilla."- 6 month"));
  $anio6mese=date('Y',strtotime($fecha6meses));

  $getPlanilla6mese=mssql_query("SELECT DISTINCT cpayno FROM prmisc WHERE CONVERT(VARCHAR(25), dcheck, 126) LIKE '%$fecha6meses%' and cpayno like '%/$anio6mese%'");
  $fila6emese=mssql_fetch_array($getPlanilla6mese);
  $Planilla6meses=$fila6emese['cpayno'];
  $arr['Planialla6mese']= $Planilla6meses;
  #optener sueldo de 6 planillas
  $getSueldo6planillas=mssql_query("SELECT nothtax FROM prmisc WHERE cpayno='$Planilla6meses' and cempno='$codigoEmpleado' and cpaycode='100'");
  $fila6planilla=mssql_fetch_array($getSueldo6planillas);
  $arr['sueldo6meses']=$fila6planilla['nothtax'];

  if($arr['sueldo6meses']){
      $sueldo6mese=$arr['sueldo6meses'];
      $sueldoultimomes=$arr['Ultimosueldo'];


      $cal1=$sueldoultimomes*6;
      $cal2=$sueldo6mese*0;

      $sum=$cal1+$cal2;
      #sueldomensual
      $sueldoMensual=$sum/6;

      $doceSueldosAlAnio=$sueldoMensual/12;

      $sueldoPrmAnual=$doceSueldosAlAnio*15;
      $totalPromAnual=$sueldoPrmAnual*0.5;


      #cesantia
      $subtotal=$sueldoPrmAnual*antiguedad($codigoEmpleado);
      $TotalSubtotal=$subtotal*0.5;


      $sueldoProm6meses=$sueldoPrmAnual;
      if (antiguedad($codigoEmpleado)==1) {
          $sueldoPrmAnual=$subtotal*0.5;

      }
      

      $arr['preaviso']=number_format($sueldoPrmAnual,2);
      $arr['cesantia']=number_format($TotalSubtotal,2);
      $Total=$sueldoPrmAnual+$TotalSubtotal;

      $arr['Total']=number_format($Total,2);

      $arr['dif']=antiguedad($codigoEmpleado);

      $arr['ultimo']= date("Y-m-t", strtotime("m")); 
      $arr['planilla']=$planilla;
      $arr['SueldoProm6mese']=number_format($sueldoProm6meses,2);
      
      





      





  }





  
 


  return $arr;
}
function mostrarhistorial($CodigoEmpleado, $fechaInicio,$fechaFinal){
ConexionSQLRecursosHumanos();


	$query=mssql_query("SELECT a.cPermisoId, b.cPeriodo, a.fDesde, a.fHasta, a.iDias,a.iHorasDiarias,a.cMotivo FROM PR_PermisoH a,PR_Permisos b WHERE b.cPermisoId =a.cPermisoId and b.cPersonaId='$CodigoEmpleado' and a.fDesde between '$fechaInicio' and '$fechaFinal' and a.Estado =1 and b.Estado =1");
	while ($dato=mssql_fetch_array($query)) {
		$dato['fDesde']=date('d/m/Y',strtotime($dato['fDesde']));
		$dato['fHasta']=date('d/m/Y',strtotime($dato['fHasta']));
		$msg[]=$dato;
	}
// and cPermisoId IN (SELECT cPermisoId FROM PR_Permisos WHERE cPersonaId='$CodigoEmpleado')

return $msg;

}

function antiguedad($cod){
  ConexionSQLserverVAM();

  $sql=mssql_query("SELECT dcntrct FROM prempy WHERE cempno ='$cod'");
  $fila=mssql_fetch_array($sql);
  $fechaINgreso=date('Y',strtotime($fila['dcntrct']));

  $date=date('Y');
 
  $opteneranio=$date-$fechaINgreso;
  
 if($opteneranio >=15){
     $opteneranio="15";
 }

  return $opteneranio;
}

function GetMes($mes){
  switch ($mes) {
    case '1':
      $msg="Enero";
      break;

    case '2':
      $msg="Febrero";
      break;

    case '3':
      $msg="Marzo";
      break;  

    case '4':
      $msg="Abril";
      break; 

    case '5':
      $msg="Mayo";
      break; 

    case '6':
      $msg="Junio";
      break; 

    case '7':
      $msg="Julio";
      break; 

    case '8':
     $msg="Agosto";
     break; 
    
     case '9':
      $msg="Septiembre";
      break; 

      case '10':
        $msg="Octubre";
        break; 

    case '11':
      $msg="Noviembre";
      break; 
          
    case '12':
      $msg="Diciembre";
      break;

    default:
      # code...
      break;
  }

  return $msg;
}

function informevacaciones($periodoempleado,$identidad){
  ConexionSQLRecursosHumanos();
  $sql=mssql_query("select h.fDesde,h.fHasta,h.iDias,h.iHorasDiarias,s.cPeriodo, h.cObservaciones from PR_Permisos s inner join PR_PermisoH h on s.cPermisoId = h.cPermisoId where s.cPeriodo='$periodoempleado' and s.cPersonaId='$identidad'");
  $retornar=[];
  while($row=mssql_fetch_array($sql)) {
   $fDesde=$row["fDesde"];
   $fHasta=$row["fHasta"];
   $iDias=$row["iDias"];

    $retornar=$row;

    
  }
 
  return $retornar;


}


?>