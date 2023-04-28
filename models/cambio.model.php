<?php
    require_once("libs/dao.php");
	require_once("models/micuenta.model.php");

	interface Cambios
	{
		public function consultarClave($password,$iduser);
		public function actualizarContra($password,$iduser);
		public function CambiarEstado($iduser);
	}
class cambio extends Conexion implements Cambios
{
	function __construct(){
        $this->msg='';
    } 

	public function consultarClave($password,$iduser){
       
		try {
			$contra= Verificacion::encriptar($password);
			$conn= self::connect();
			$sql=$conn->prepare("SELECT * FROM usuarios WHERE contrasenia=:pass and id_usuario=:id");
			$sql->execute(["pass"=>$contra, "id"=>$iduser]);
			if ($sql->rowCount() > 0) {
				$bool=0;
			}else{
				$bool=1;
			}
			return $bool;

		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}
	public function actualizarContra($password,$iduser){
       
		try {
			

			$contra= Verificacion::encriptar($password);
			$conn= self::connect();
			$sql=$conn->prepare("UPDATE public.usuarios SET contrasenia=:pass WHERE id_usuario=:id");
			$sql->execute(["pass"=>$contra, "id"=>$iduser]);
			if ($sql) {
				$bool=1;
				$this->CambiarEstado($iduser);
			}else{
				$bool="Error al Guardar los cambios";
			}
			return $bool;

		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}

	public function CambiarEstado($iduser){
		try {
			

			
			$conn= self::connect();
			$sql=$conn->prepare("UPDATE public.usuarios SET cambiocontrasenia=true WHERE id_usuario=:id");
			$sql->execute(["id"=>$iduser]);
			

		
		} catch (PDOException $exception) {
			exit($exception->getMessage());
		}
	}



}
 ?>

