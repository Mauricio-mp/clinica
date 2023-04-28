<?php
session_start();
ob_start();
  require_once("libs/dao.php");
  header('Content-Type: text/html; charset=ISO-8859-1');
  define('METHOD','AES-256-CBC');
     define('SECRET_KEY','$Ministerio@2020');
     define('SECRET_IV','101712');




     function optenerMotivos(){
        $dbConn= connect();
       
          $sql = $dbConn->prepare("SELECT * from public.motivo  where estado=:Estado");
      
          
      $sql->execute(["Estado"=>TRUE]); 
      
          $sql->setFetchMode(PDO::FETCH_ASSOC);
         
          $filas=$sql->fetchAll();
         //$fila['descripcion']=utf8_encode($fila['descripcion']);
          return $filas;
      
         
          
        }

      
  function IngresoPermiso($Tipo,$F_inicio,$F_Fin,$TotalMinutos,$Observacion,$inicio,$fin,$CbxMotivo,$Codigo,$identidad,$nombre){
    $sesionusuario=$_SESSION['usuario'];
    $timezone = new DateTimeZone('America/Tegucigalpa');

    $date = new DateTime('2000-01-01',$timezone);
$fecha= $date->format('Y-m-d H:i:s',$timezone);

    $dbConn= connect();
       //INSERT INTO public.ingreso_permiso (id_motivos, fecha_inicio, fecha_final, cantidad_minutos, onservacion, tipo_permiso, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
//VALUES(0, '', '', '', '', '', false, '', '', '', '');
try {
  $sql = $dbConn->prepare("INSERT INTO public.ingreso_permiso
          (fecha_inicio,Tipo_Inicio,fecha_final,tipo_fin,cantidad_minutos,observacion,tipo_permiso,tipo_motivo,codigo_vam,identidad,estado,usuario_creacion,fecha_creacion,nombre) VALUES(:FechaInicio,:Tipo_Inicio,:FechaFinal,:tipo_fin,:cantidadMinutos,:observacion,:Tipo_Permiso,:Tipo_Motivo,:codigo_vam,:identidad,1,:creacion,current_timestamp,:nombre)");

$sql->execute(["FechaInicio"=>$inicio,"Tipo_Inicio"=>$F_inicio,"FechaFinal"=>$fin,":tipo_fin"=>$F_Fin,"cantidadMinutos"=>$TotalMinutos,"observacion"=>$Observacion,"Tipo_Permiso"=>$Tipo,"Tipo_Motivo"=>$CbxMotivo,"codigo_vam"=>$Codigo,"identidad"=>$identidad,"creacion"=>$sesionusuario,"nombre"=>$nombre]); 
}
catch (PDOException $e){
  return $e->getMessage();
}
if($sql==true){
  return true;
}else{
  return $dbh->errorInfo();
}


  }

  function IngresoPorDias($CbxHabiles,$CbxMotivo,$Inicio,$Fin,$Observacion,$tipo,$identidad,$Codigo,$nombre){
    $dbConn= connect();
$sesionusuario=$_SESSION['usuario'];
      $datos= daysWeek($Inicio, $Fin,$CbxHabiles);
      $cantidadDias=$datos['dias'];
      $cantidadMinutos=$datos['minutos'];
      
      //INSERT INTO public.ingreso_permiso (id_motivos, fecha_inicio, fecha_final, cantidad_minutos, onservacion, tipo_permiso, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
//VALUES(0, '', '', '', '', '', false, '', '', '', '');
try {
 $sql = $dbConn->prepare("INSERT INTO public.ingreso_permiso
         (fecha_inicio,fecha_final,cantidad_minutos,cantidad_dias,observacion,tipo_permiso,tipo_motivo,codigo_vam,identidad,estado,usuario_creacion,fecha_creacion,nombre)
          VALUES(:FechaInicio,:FechaFinal,:cantidadMinutos,:cantidad_dias,:observacion,:Tipo_Permiso,:Tipo_Motivo,:codigo_vam,:identidad,1,:creacion,current_timestamp,:nombre)");

$sql->execute(["FechaInicio"=>$Inicio,"FechaFinal"=>$Fin,"cantidadMinutos"=>$cantidadMinutos,"cantidad_dias"=>$cantidadDias,"observacion"=>utf8_encode($Observacion),"Tipo_Permiso"=>$tipo,"Tipo_Motivo"=>$CbxMotivo,"codigo_vam"=>$Codigo,"identidad"=>$identidad,"creacion"=>$sesionusuario,"nombre"=>$nombre]); 
}
catch (PDOException $e){
 return $e->getMessage();
}
if($sql==true){
 return true;
}else{
 return $sql;
}
    
    
  }

  function daysWeek($inicio, $fin,$CbxHabiles){
    $timezone = new DateTimeZone('America/Tegucigalpa');


    $start = new DateTime($inicio,$timezone);
    $end = new DateTime($fin,$timezone);


    //de lo contrario, se excluye la fecha de finalización (¿error?)
    $end->modify('+1 day');

    $interval = $end->diff($start);

    // total dias
    $days = $interval->days;

    // crea un período de fecha iterable (P1D equivale a 1 día)
    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

    // almacenado como matriz, por lo que puede agregar más de una fecha feriada
    $holidays = array('2012-09-07');

    if($CbxHabiles=='on'){
      foreach($period as $dt) {
        $curr = $dt->format('D');

        // obtiene si es Sábado o Domingo
        if($curr == 'Sat' || $curr == 'Sun') {
            $days--;
        }elseif (in_array($dt->format('Y-m-d'), $holidays)) {
            $days--;
        }
    }
    }

    
    $horas=$days*8;
    $minutos=$horas*60;
    $array=array('dias' =>$days,
                  'minutos'=>$minutos);
    return $array;
}
function Ingreso($CbxMotivo,$Inicio,$Fin,$Observacion,$tipo,$dias){

  return 0;
}


?>