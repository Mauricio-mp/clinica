<?php
    require_once("libs/dao.php");
    /*
    function obtenerTodosMensajes(){
        $sqlstr = "Select * from mensajes;";
        return obtenerRegistros($sqlstr);
    }
    */
    function obtenerTodosLosCursos(){
      $clientes= array();
      $sqlstr = "select *from clientes;";
      $clientes = obtenerRegistros($sqlstr);
      return $clientes;
    }


    //YYYMMMDDD asi cmo esta ej 20180304
    function nuevoCurso($Codigo, $descripcion, $estado,$FechaTarea,$CorreoCliente){
      $insql =  "INSERT INTO `clientes` (`Codigo`, `Descripcion`, `Estado`,`FechaTarea`,`CorreoCliente`) VALUES ('%d', '%s', '%s','%s','%s');";
      $insql = sprintf($insSql,valstr($Codigo), valstr($Descripcion), valstr($Estado),valstr($FechaTarea),valstr($CorreoCliente));
      $resultado= ejecutarNonQuery($insSql);
      return $resultado && true;

    }
    function actualizarCurso($codigo_curso, $desc_curso, $est_curso){
      $updSql = "UPDATE `clientes` SET `Descripcion`='%s',`Estado`='%s',`FechaTarea`='%s',`CorreoCliente`='%s' WHERE `Codigo`='%s';";
    $updSql = sprintf($updSql,valstr($Codigo), valstr($Descripcion), valstr($Estado),valstr($FechaTarea),valstr($CorreoCliente));
    $resultado= ejecutarNonQuery($updSql);
      return $resultado && true;clientes
    function eliminarCurso($Codigo){
      $delSql = "DELETE from `clientes`  WHERE `Codigo`='%s';";
      $delSql = sprintf($delSql,valstr($Codigo));
      $resultado= ejecutarNonQuery($delSql);
      return $resultado && true;
    }
    function mantenerCurso($Codigo){
      $dspSql = "select * from `clientes` WHERE `Codigo`='%s';";
      $dspSql = sprintf($dspSql,valstr($Codigo));
      $resultado= obtenerRegistros($dspSql);
      return $resultado;
    }
 ?>
