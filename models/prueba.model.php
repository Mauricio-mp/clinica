<?php 
session_start();
ob_start();
  require_once("libs/dao.php");
  header('Content-Type: text/html; charset=ISO-8859-1');
 define('METHOD','AES-256-CBC');
     define('SECRET_KEY','$Ministerio@2020');
     define('SECRET_IV','101712');
class Persona
{
  public $dpi;
  public $nombre;
  public $edad;

  function __construct($dpi,$nombre,$edad)
  {
    $this->dpi=$dpi;
    $this->nombre=$nombre;
    $this->edad=$edad;
  }

  public function getDatosPersonales(){
    $datos="
    <h2>Datos Personales</h2>
    DPI:{$this->dpi}</br>
    Nombre:{$this->nombre}</br>
    Edad:{$this->edad}</br>
    ";
    return $datos;
  }
}


class Productos
{
  public $strDescripcion;
  public $fltPrecio;
  protected $intStockMinimo=10;
  protected $strstatus="Activo";

  public function __construct($strDescripcion,$fltPrecio)
  {
    $this->strDescripcion=$strDescripcion;
    $this->fltPrecio=$fltPrecio;
  }

  public function getInfo(){
    $arrayProducto= $arrayName = array('producto' =>$this->strDescripcion ,
    'precio'=>$this->fltPrecio,
    'stock-minimo'=>$this->intStockMinimo,
    'estado'=>$this->strstatus);

    return $arrayProducto;
  }


}

interface Operation 
{
  public function raizcuadrada($numero);
  public function Potencia($numero,$potencia);



}

interface OperationBacsic
{

  
  public function op_basica($numero1,$numero2,$operacion);



}

renderizar("prueba",$data=['hola'=>'dsdsd']);


  

?>