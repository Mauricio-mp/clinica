<?php
    require_once("libs/dao.php");
    /*
    function obtenerTodosMensajes(){
        $sqlstr = "Select * from mensajes;";
        return obtenerRegistros($sqlstr);
    }
    */
    function obtenerTodosLosCursos(){
      $cursos= array();
      $sqlstr = "select *from cursos;";
      $cursos = obtenerRegistros($sqlstr);
      return $cursos;
    }


    
    //YYYMMMDDD asi cmo esta ej 20180304
    function nuevoCurso($codigo_curso, $desc_curso, $est_curso){
      $insql =  "INSERT INTO `cursos` (`codigo_curso`, `desc_curso`, `estado_curso`) VALUES ('%s', '%s', '%s');";
      $insql = sprintf($insSql,valstr($codigo_curso), valstr($desc_curso), valstr($est_curso));
      $resultado= ejecutarNonQuery($insSql);
      return $resultado && true;

    }
    function actualizarCurso($codigo_curso, $desc_curso, $est_curso){
      $updSql = "UPDATE `cursos` SET `desc_curso`='%s',`estado_curso`='%s' WHERE `codigo_curso`='%s';";
    $updSql = sprintf($updSql,valstr($codigo_curso), valstr($desc_curso), valstr($est_curso));
    $resultado= ejecutarNonQuery($updSql);
      return $resultado && true;

    }

    function eliminarCurso($codigo_curso){
      $delSql = "DELETE from `cursos`  WHERE `codigo_curso`='%s';";
      $delSql = sprintf($delSql,valstr($codigo_curso));
      $resultado= ejecutarNonQuery($delSql);
      return $resultado && true;
    }
    function mantenerCurso($codigo_curso){
      $dspSql = "select * from `cursos` WHERE `codigo_curso`='%s';";
      $dspSql = sprintf($dspSql,valstr($codigo_curso));
      $resultado= obtenerRegistros($dspSql);
      return $resultado;
    }
 ?>
