<?php
/* generar Controller
 * 2021-10-14
 * Created By DMLL
 * Last Modification 2014-10-14 20:04
 */
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
*/

use Operacion as GlobalOperacion;

session_start();
ob_start();

  require_once("libs/template_engine.php");
require_once("models/prueba.model.php");
addToContext("page_title","Personal - Ingreso");
addToContext("form_title","Busqueda");

class Coche {
  protected $color;
  public function setColor($color)
  {
      $this->color = $color;
  }
  public function getColor()
  {
      return $this->color;
  }
  public function printCaracteristicas()
  {
      echo 'Color: '. $this->getColor;
  }
}

class CocheDeLujo extends Coche {
  protected $extras;
  public function setExtras($extras)
  {
      $this->extras = $extras;
  }
  public function getExtras()
  {
      return $this->extras;
  }
  public function printCaracteristicas()
  {
      echo 'Color: '. $this->color;
      echo '<hr/>';
      echo 'Extras: ' . $this->extras;
  }
}

$miCoche = new CocheDeLujo();
$miCoche->setColor('negro');
$miCoche->setExtras('TV');

$miCoche->printCaracteristicas(); // Devuelve Color : negro Extras: TV

echo "</br>";

class Prueba {
 
   public static  $variable='dsdsdsds';
  
  
}
echo '<hr/>';
echo Prueba::$variable;

$prueba = new Prueba();
echo $prueba::$variable . "\n";
echo '<hr/>';

class car {
  public function getMarca() {
      echo  'Renault ';
  }
}
trait Modelo {
  public function getModelo() {
      parent::getMarca();
      echo 'Clio';
  }
}
class Ventas extends car {
  use Modelo;
}

$o = new Ventas();
$o->getMarca(); // Podemos obtener este método de la clase Coche
$o->getModelo(); // Podemos obtener este método del trait Modelo
echo "\n";
echo '<hr/>';


class ClasePincipal
{
  public $nombre;
  public $apellido;
  protected $edad;

  public function __Construct($nombre,$edad) {
    $this->edad=$edad;
    $this->nombre=$nombre;
  }

  public function get_edad(){
    return $this->edad;
  }
  public function get_nombre(){
    return $this->nombre;
  }

  public function mostrar_info(){
    return $this->get_edad()."\t".$this->get_nombre();
  }




}

$Denis= new ClasePincipal("Denis",40);

echo $Denis->mostrar_info();
echo '<hr/>';

class Operacion
{
  public $cantidadUno=0;
  public $cantidadDos=0;
  private $resultado=0;

  public function __Construct($cantidadUno,$cantidadDos){
    $this->cantidadUno =$cantidadUno;
    $this->cantidadDos =$cantidadDos;
  }

  public function getsuma(){
    $this->resultado=$this->cantidadUno + $this->cantidadDos;
    return $this->resultado;
  }

  public function getresta(){
    $this->resultado=$this->cantidadUno - $this->cantidadDos;
    return $this->resultado;
  }

  public function getmultiplicacion(){
    $this->resultado=$this->cantidadUno * $this->cantidadDos;
    return $this->resultado;
  }

  public function getdivision(){
    $this->resultado=$this->cantidadUno / $this->cantidadDos;
    return $this->resultado;
  }


  

}
$operacion1= new Operacion(28,10);

echo "resta:\t".$operacion1->getresta(); 

//renderizar("techo",$data=['hola']);
echo "<hr/>";

class Usuario
{
  private $strnombre;
  private $strEmail;
  private $strTipo;
  private $strClave;
  protected $strFechaRegistro;
  static $strEstado="Estado";

  public function __construct($strnombre, $strEmail, $strTipo)
  {
    $this->strnombre=$strnombre;
    $this->strEmail=$strEmail;
    $this->strTipo=$strTipo;
    $this->strClave=rand();
    $this->strFechaRegistro=date('Y-m-d');

  }

  public function getNombre() {
    return $this->strnombre;
  }

  public function GetDatos(){
    $html = "Nombre:\t".$this->strnombre;
    $html .= "</br>";
    $html .= "Apellido:\t".$this->strEmail;
    $html .= "</br>";
    $html .= "Clave:\t".$this->strClave;
    $html .= "</br>";
    $html .= "Fecha:\t".$this->strFechaRegistro;

    return $html;
  }

  public function CambiarClave($pass){
    $this->strClave=$pass;
  }

  public function CambiarNombre($NuevoNombre){
    $this->strnombre=$NuevoNombre;
  }

}
$objUsuario= new Usuario("Denis Lopez","mauriciolopezdeni@gmail.com","local");
$objUsuario->CambiarNombre('Marciano Dias');
$objUsuario->CambiarClave('895623');
echo $objUsuario->GetDatos();
echo "<hr/>";
##  Herencias #####
class Empleado extends Persona
{
  protected $strPuesto;
  public function __construct($dpi,$nombre,$edad)
  {
    parent::__construct($dpi,$nombre,$edad);

  }
  public function setPuesto($puesto){
    $this->strPuesto=$puesto;
  }
  public function getPuesto(){
    return $this->strPuesto;
  }
}

class Cliente extends Persona
{
  protected $fltCredito;
  public function __construct($dpi,$nombre,$edad)
  {
    parent::__construct($dpi,$nombre,$edad);

  }
  public function setCredito($puesto){
    $this->fltCredito=$puesto;
  }
  public function getCredito($puesto){
    return $this->fltCredito;
  }
}

$objEmpleado=new Empleado(875,"Omar Rodriguez","85");
$objEmpleado->setPuesto("Administrador");
echo $objEmpleado->getDatosPersonales();
echo $objEmpleado->getPuesto();


## Polimorfismo , redefinicion de metodos y propiedades ####
class Mueble extends Productos 
{
  public $strColor;
  public $strMAterial;
  public $strStatus="Agotado";

  public function __construct($strDescripcion,$fltPrecio,$strColor,$strMAterial)
  {
    parent::__construct($strDescripcion,$fltPrecio);
    $this->strMAterial=$strMAterial;
    $this->strColor=$strColor;
  }
  public function getInfo(){
    $arrayProducto= $arrayName = array('producto' =>$this->strDescripcion ,
    'precio'=>$this->fltPrecio,
    'stock-minimo'=>$this->intStockMinimo,
    'estado'=>$this->strstatus,
    'color'=>$this->strColor,
    'Material'=>$this->strMAterial);

    return $arrayProducto;
  }

}
class Mesa extends Mueble 
{
  private $strForma="si";
  protected $strTamanio;


  public function __construct($strDescripcion,$fltPrecio,$strColor,$strMAterial,$strTamanio)
  {
    parent::__construct($strDescripcion,$fltPrecio,$strColor,$strMAterial,$strTamanio);
    $this->strTamanio=$strTamanio;
  }

  public function setForma($strForma) {
  $this->strForma=$strForma;
  }
  public function getInfo(){
    $arrayProducto= $arrayName = array('producto' =>$this->strDescripcion ,
    'precio'=>$this->fltPrecio,
    'stock-minimo'=>$this->intStockMinimo,
    'estado'=>$this->strstatus,
    'color'=>$this->strColor,
    'forma'=>$this->strForma,
    'Tamanio'=>$this->strTamanio,
    'Material'=>$this->strMAterial);

    return $arrayProducto;
  }

}

$objCama=new Productos("Cama",847.25);
$arrayInfoProducto=$objCama->getInfo();
print('<pre>');
print_r($arrayInfoProducto);
print('</pre>');

$objMesa=new Mesa("Cama",847.25,"Rojo","colchon","grande");
$arrayInfoProducto=$objMesa->getInfo();
print('<pre>');
print_r($arrayInfoProducto);
print('</pre>');

## Interfaces ####

class Calcular implements Operation,OperationBacsic
{
  public function raizcuadrada($numero){
    $total=sqrt($numero);

    return $total;
  }

  public function Potencia($numero,$potencia){
    $total=pow($numero,$potencia);

    return $total;
  }
  public function op_basica($numero1,$numero2,$operacion){
 

    return $operacion;
  }
}

$objRaiz=new Calcular();
echo $objRaiz->raizcuadrada(9);

$objPotencia=new Calcular();
echo $objPotencia->Potencia(9,2);


$objBasica=new Calcular();
echo $objBasica->op_basica(9,2,"multiplicar");
?>
