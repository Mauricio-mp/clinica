<?php 
session_start();
ob_start();

  require_once("libs/dao.php");
 
class Reporte{

function __construct()
{
    $this->fechaInicial='';
    $this->fechaFinal='';
    $this->id='';
}
    public function getDatos($fechaFin,$fechaInicio){
        $dbConn= connect();
        $this->fechaInicial=$fechaInicio;
        $this->fechaFinal=$fechaFin;

try {
    $sql = $dbConn->prepare("SELECT * FROM public.tb_incapacidad a, public.tb_techo b where b.id_techo= a.id_techo and a.fecha_creada BETWEEN :fechaInicio and :fechaFin ");
   
   $sql->execute(["fechaInicio"=>$this->fechaInicial,"fechaFin"=> $this->fechaFinal]); 

   return ($sql) ? $sql->fetchAll() : false;
   }
   catch (PDOException $e){
    return $e->getMessage();
   }
   
    }

    public function getDatosUsuario($id){
      $dbConn= connect();
      $this->id=$id;
try {
  $sql = $dbConn->prepare("SELECT * FROM public.usuarios u where u.id_usuario=:id");
 
 $sql->execute(["id"=>$this->id]); 

 return ($sql) ? $sql->fetch(PDO::FETCH_OBJ) : false;
 }
 catch (PDOException $e){
  return $e->getMessage();
 }
 
  }
  public function getDatosjefe(){
    $dbConn= connect();
   
try {
$sql = $dbConn->prepare("SELECT * from public.tb_Firmas where estado=true");

$sql->execute(); 

return ($sql) ? $sql->fetch(PDO::FETCH_OBJ) : false;
}
catch (PDOException $e){
return $e->getMessage();
}

}
}

function prueba($fechainicio,$fechafinal,$id){
    require('Pdf/fpdf/WriteTag.php');


//$identidad=$_SESSION["idem"];
$periodo=$_SESSION["periodoseleccionar"];
$jefes=$_SESSION["jefes"];
$observacion=$_SESSION["observacionsaldo"];
//$nombre=$_SESSION['logeo'];








//$datos=mostrardatosTrab($mes);
//$num=count($datos);
class PDF extends PDF_WriteTag
{
function Header()
{
    $txt="<h1>Le petit chaperon rouge</h1>";
    $this->SetStyle("p","Arial","",10,"0,0,0",0);
    $this->SetStyle("h1","arial","N",13,"0,0,0",0);
    $this->SetStyle("a","arial","BU",13,"0,0,0");
    $this->SetStyle("pers","arial","I",0,"0,0,0");
    $this->SetStyle("place","arial","U",0,"0,0,0");
    $this->SetStyle("vb","arial","B",6,"0,0,0");
    // Logo
    $this->Image('img/9.png',121,6,50);
  
    // Arial bold 15
      $this->Ln(20);
     $this->SetFont('Arial','B',7);
     $this->Cell(270,0,'REPORTE DE INCAPACIDADES',0,0,'C');
     $this->Ln(5);
     $this->Cell(270,0,'DEPARTAMENTO DE PERSONAL',0,0,'C');
    //$this->SetTextColor(194,8,8);
    //$this->Cell(45,0,'Prueba',0,0,'C');
    // Move to the right
    $this->SetFont('Arial','I',8);
     $this->SetTextColor(0,0,0);
  
  
$txt="<vb></vb>";
$this->WriteTag(0,5,$txt,0,"L");


$this->SetFillColor(224,235,225);
$this->SetTextColor(0);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$this->Ln();
    $header = array('No.','CERTIFICADO', 'NOMBRE', 'FECHA INICIO', 'FECHA ALTA','DIAS','TECHO','TOTAL','PATRONAL','OBSERVACION');
    for ($j = 0; $j <count($header) ; $j++) {
        
      
        if($j==0){
           $num=11;
         }elseif($j==1){
          $num=20;
         }elseif($j==2){
          $num=75;
         }elseif($j==3){
          $num=20;
         }elseif($j==4){
          $num=20;
         }elseif($j==5){
          $num=10;
         }elseif($j==6){
          $num=20;
         }elseif($j==7){
         $num=29;
         }elseif($j==8){
            $num=25;
        
        }elseif($j==9){
            $num=45;
           }
      
     

         $this->Cell($num,6,$header[$j],1,0,'C',TRUE);
   
         //$this->Multicell(25, 15,$header[$j], 1, 'C', 0);
        
      
      //Restauración de colores y fuentes
      
      }
 
}

// Page footer
function Footer()
{
    

  $this->SetFont('Arial','',8);
  
  $this->SetY(-10);
  $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');


}
function TablaColores($data,$header,$fechainicio,$fechafinal)
{
//Colores, ancho de línea y fuente en negrita
$contado=0;
$sumador=0;
$reseteo=0;
$this->SetFillColor(224,235,225);
$this->SetTextColor(0);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$fill=false;
//Cabecera
$this->SetFont('Arial','I',9);
  //$this->Cell(195,6,"# de Lote:\n".$data[0]['Apellido'],0,0,'R',$fill);


  $comm= new Reporte();
  $data=$comm->getDatos($fechafinal,$fechainicio);
for($i=0;$i<count($comm->getDatos($fechafinal,$fechainicio));$i++)
{
  
$this->Ln();
$this->SetFont('Arial','I',8);

//Datos
if(($i % 2) == 0){
  $fill=false;
}else{
  $fill=true;
}
$comm= new Reporte();
$contado++;
$reseteo++;
if($reseteo == 31 ){
    $this->AddPage('L');
    $this->Ln();
    $reseteo=1;
}

$this->Cell(11,4,$contado,'LR',0,'C',$fill);
$this->Cell(20,4,$data[$i]['certificado'],'LR',0,'L',$fill);
$this->Cell(75,4,utf8_decode($data[$i]['nombre_completo']),'LR',0,'L',$fill);
$this->Cell(20,4,date('d/m/Y',strtotime($data[$i]['fecha_inicial'])),'LR',0,'C',$fill);
$this->Cell(20,4,date('d/m/Y',strtotime($data[$i]['fecha_final'])),'LR',0,'L',$fill);
$this->Cell(10,4,$data[$i]['dias'],'LR',0,'C',$fill);
$this->Cell(20,4,$data[$i]['cantidad'],'LR',0,'C',$fill);
$this->Cell(29,4,$data[$i]['total'],'LR',0,'R',$fill);
$this->Cell(25,4,$data[$i]['codigo_patronal'],'LR',0,'C',$fill);
$this->Cell(45,4,utf8_decode($data[$i]['observacion']),'LR',0,'L',$fill);
$sumador=$data[$i]['total']+$sumador;


   $this->Ln();
  $this->Cell(275,0,'','T');
}
$this->WriteTag(0,0,"<strong></strong>",0,"L");
$this->Ln();
$this->Cell(11,4,"",'',0,'L',false);
$this->Cell(115,4,"Total",'LB',0,'L',false);
$this->Cell(79,4,"L. ".number_format($sumador,2),'BR',0,'R',false);

}
}
// Instanciation of inherited class


$pdf=new PDF();
$pdf->AddPage('L');

//marca de agua
$pdf->SetStyle("p","Arial","",10,"0,0,0",0);
$pdf->SetStyle("h1","arial","N",13,"0,0,0",0);
$pdf->SetStyle("a","arial","BU",13,"0,0,0");
$pdf->SetStyle("pers","arial","I",0,"0,0,0");
$pdf->SetStyle("place","arial","U",0,"0,0,0");
$pdf->SetStyle("vb","arial","B",11,"0,0,0");
$pdf->SetStyle("strong","arial","B",8,"0,0,0");



// $pdf->SetAlpha(0.2);


//  $pdf->Image('img/9.png',0,85,225);

//  $pdf->SetAlpha(1);


/* Data loading */






$pdf->TablaColores($data,$header,$fechainicio,$fechafinal);

$pdf->Ln(25);
$txt=" 
<p>Il <vb>était</vb> une fois <pers>une petite fille</pers> de <place>village</place>, 
la plus jolie qu'on <vb>eût su voir</vb>: <pers>sa mère</pers> en <vb>était</vb> 
folle, et <pers>sa mère grand</pers> plus folle encore. Cette <pers>bonne femme</pers> 
lui <vb>fit faire</vb> un petit chaperon rouge, qui lui <vb>seyait</vb> si bien 

";

$usuario= new Reporte();
$pdf->SetFont('Arial','B',6);
$datosUsuario=$usuario->getDatosUsuario($id);
$datosjefe=$usuario->getDatosjefe();
$pdf->Cell(138,4,"LIC.\t".strtoupper($datosUsuario->nombrecompleto),0,0,'C',false);
$pdf->Cell(138,4,strtoupper($datosjefe->nombre),0,0,'C',false);

$pdf->Ln();

$pdf->Cell(138,4,strtoupper($datosUsuario->acccion),0,0,'C',false);
$pdf->Cell(138,4,$datosjefe->cargo,0,0,'C',false);
$pdf->Ln();

$pdf->Cell(138,4,"MINISTERIO PUBLICO",0,0,'C',false);
$pdf->Cell(138,4,$datosjefe->dependendia,0,0,'C',false);





$pdf->Output();
}



  

?>