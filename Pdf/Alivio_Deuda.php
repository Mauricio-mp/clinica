<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
session_start();
ob_start();





class PDF extends PDF_WriteTag
{
function Header()
{

    // Logo
    //$this->Image('../img/9.png',70,6,75);
    $this->Image("../images/logo.png",70,5,75,0,"","../index.php?page=Deuda");
    // Arial bold 15
      $this->Ln(30);
     $this->SetFont('Arial','B',11);
     $this->Cell(185,0,'DEPARTAMENTO DE PERSONAL',0,0,'C');
     $this->Ln(5);
     $this->Cell(185,0,'SECCION DE BENEFICIOS SOCIALES',0,0,'C');
     $this->Ln(9);
     $this->Cell(185,0,'PROYECCION PARA PRESTAMOS ALIVIO DE LA DEUDA',0,0,'C');
     $this->Ln(5);
     $this->Cell(185,0,'CALCULO PROYECTADO DE INDEMNIZACION AL 50%',0,0,'C');
    //$this->SetTextColor(194,8,8);
    //$this->Cell(45,0,'Prueba',0,0,'C');
    // Move to the right
     $this->SetFont('Times','B',14);
     $this->SetTextColor(0,0,0);
    $this->Ln(30);
   // $this->Cell(72);
    // Title

    //$this->Cell(45,0,'CONSTANCIA',0,0,'C');
    // Line break
    //$this->Ln(20);
}

// Page footer
function Footer()
{
    
  //   global $nombreCompleto;
  //   global $Empleado;
  //   global $identidad;
  //  $this->SetFont('Arial','I',8);
 
  // $this->SetY(-15);
  // $this->Cell(185,0,'Nombre: '.$nombreCompleto,0,0,'L');
  //  $this->Ln(3);
  //  $this->Cell(185,0,'Codigo: '.$Empleado,0,0,'L');
  //  $this->Ln(3);
  //  $this->Cell(185,0,'Identidad: '.$identidad,0,0,'L');
  // Arial italic 8
  $this->SetFont('Arial','',8);
  // Número de página
//  $this->SetY(-10);
  //$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C');
}

}

// Instanciation of inherited class


$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',13);
$pdf->SetLeftMargin(18); #Establecemos los márgenes izquierda: 
$pdf->SetRightMargin(18); #Establecemos los márgenes Derecha: 
$pdf->AliasNbPages();





// Stylesheet
$pdf->SetStyle("p","Arial","",10,"0,0,0",0);
$pdf->SetStyle("h1","arial","N",13,"0,0,0",0);
$pdf->SetStyle("a","arial","BU",13,"0,0,0");
$pdf->SetStyle("pers","arial","I",0,"0,0,0");
$pdf->SetStyle("place","arial","U",0,"0,0,0");
$pdf->SetStyle("vb","arial","B",11,"0,0,0");








// $pdf->Cell(30,0,"Nombre Completo",0,1,'L'); 
// $pdf->Cell(30,0,"Nombre Completo",0,1,'L'); 
// $pdf->Cell(30,0,"Nombre Completo",0,1,'L'); 
// $pdf->Cell(120,0,utf8_encode(trim($Data[0])." ".trim($Data[1])),1,1,'R'); 
// $pdf->Ln(10);
// $pdf->Cell(30,0,"Identidad",0,1,'L'); 
// $pdf->Cell(120,0,utf8_encode(trim($Data[0])),0,1,'R'); 



// $pdf->SetXY(20, 50);
// $pdf->SetFont('Arial','B',14);
// $pdf->Cell(15,6,"Nombre Completo",0,1,"L"); 
// $pdf->Ln(10);
// $pdf->SetXY(80, 50);
// $pdf->SetFont('Arial','',14);
// $pdf->Cell(15,6,"Denis Mauricio"." "."Lopez Larreynaga",0,1,"L"); 
// $pdf->SetXY(20, 60);
// $pdf->SetFont('Arial','B',14);
// $pdf->Cell(15,6,"Identidad",0,1,"L"); 
// $pdf->SetXY(80, 60);
// $pdf->SetFont('Arial','',14);
// $pdf->Cell(15,6,"0318-1994-01214",0,1,"L"); 

$pdf->Ln(10);




$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(177,177,177);
$pdf->SetFontSize(12);
$pdf->SetXY(21, 75);
$pdf->Cell(164, 7, 'DATOS GENERALES', 1, 1, 'C', true);


      $pdf->SetFont('Arial','',11);
      $pdf->SetXY(21, 82);
      $pdf->Cell(80, 9, 'Nombre del Servidor', 'L', 1, 'L', false);
    
    
      $pdf->SetXY(100, 82);
      $pdf->Cell(85,9,'sass', 'R', 1, 'L', false);

      $pdf->SetXY(21, 91);
      $pdf->Cell(89,9,'Puesto', 'L', 1, 'L', false);

      $pdf->SetXY(100, 91);
      $pdf->Cell(85,9,'holaaa', 'R', 1, 'L', false);

      $pdf->SetXY(21, 100);
      $pdf->Cell(85,9,'Fecha de Ingreso', 'L', 1, 'L', false);

      $pdf->SetXY(100, 100);
      $pdf->Cell(85,9,'holaaa', 'R', 1, 'L', false);

      $pdf->SetXY(21, 109);
      $pdf->Cell(85,9,'Fecha de Proyeccion', 'L', 1, 'L', false);

      $pdf->SetXY(100, 109);
      $pdf->Cell(85,9,'holaaa', 'R', 1, 'L', false);

      $pdf->SetXY(21, 118);
      $pdf->Cell(85,9,utf8_decode('Antigüedad'), 'L', 1, 'L', false);

      $pdf->SetXY(100, 118);
      $pdf->Cell(85,9,utf8_decode('holaaa'), 'R', 1, 'L', false);

      $pdf->SetXY(21, 127);
      $pdf->Cell(89,9,utf8_decode('Sueldo Ordinario'), 'L', 1, 'L', false);

      $pdf->SetXY(100, 127);
      $pdf->Cell(85,9,'holaaa', 'R', 1, 'L', false);

      

      $pdf->SetXY(21, 136);
      $pdf->Cell(122,9,utf8_decode('Sueldo Pomedio devengado de los ultmimos 6 meses LPS:'), 'LB', 1, 'L', false);

      $pdf->SetXY(130, 135);
      $pdf->Cell(55,10,'holaaa', 'RB', 1, 'L', false);

     

      $pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(177,177,177);
$pdf->SetXY(21, 168);
$pdf->Cell(164, 7, 'CALCULO DE INDEMNIZACIONES', 1, 1, 'C', true);
$pdf->SetFillColor(255);
/* --- Cell --- */
$pdf->SetFillColor(177,177,177);
$pdf->SetXY(21, 175);
$pdf->Cell(54, 7, 'DETALLE', 1, 1, 'C', true);
$pdf->SetFillColor(255);
/* --- Cell --- */
$pdf->SetFillColor(177,177,177);
$pdf->SetXY(129, 175);
$pdf->Cell(56, 7, 'VALOR', 1, 1, 'C', true);
$pdf->SetFillColor(255);
/* --- Cell --- */
$pdf->SetFillColor(177,177,177);
$pdf->SetXY(75, 175);
$pdf->Cell(54, 7, 'TIEMPO (MES)', 1, 1, 'C', true);
$pdf->SetFillColor(255);
/* --- Cell --- */
$pdf->SetFont('Arial','',9);
$pdf->SetXY(75, 182);
$pdf->Cell(54, 7, $tiempoPreaviso, 1, 1, 'C', false);
/* --- Cell --- */
$pdf->SetXY(21, 182);
$pdf->Cell(54, 7, 'PREAVISO', 1, 1, 'L', true);

$pdf->SetXY(129, 182);
$pdf->Cell(56, 7, $datos['preaviso'], 1, 1, 'R', true);

$pdf->SetXY(21, 189);
$pdf->Cell(54, 7,utf8_decode('CESANTIA(AÑOS COMPLETOS)'), 1, 1, 'L', true);

$pdf->SetXY(75, 189);
$pdf->Cell(54, 7, $tiempocesantia, 1, 1, 'C', true);

$pdf->SetXY(129, 189);
$pdf->Cell(56, 7, $datos['cesantia'], 1, 1, 'R', true);

$pdf->SetFont('Arial','B',9);
$pdf->SetXY(21, 196);
$pdf->Cell(54, 7, 'TOTAL', 1, 1, 'L', true);

$pdf->SetXY(75, 196);
$pdf->Cell(54, 7, "", 1, 1, 'L', true);

$pdf->SetXY(129, 196);
$pdf->Cell(56, 7, $datos['Total'], 1, 1, 'R', true);


$pdf->SetFont('Arial','',11);

$pdf->SetXY(75, 230);


$Mes=GetMes(date("m"));

$pdf->Cell(65,6,"Tegucigalpa M.D.C.".date('d')." De ".$Mes." del ".date('Y'),0,1,"C");




$pdf->Line(20, 262, 90, 262);
/* --- Line --- */
$pdf->Line(120, 262, 190, 262);
/* --- Cell --- */
$pdf->SetXY(28, 264);
$pdf->Cell(46, 7, 'Elaborado por: ', 0, 1, 'C', false);
$pdf->SetXY(28, 269);
$pdf->Cell(46, 6, 'Denis Lopez', 0, 1, 'C', true);
/* --- Cell --- */
$pdf->SetXY(127, 265);
$pdf->Cell(0, 4, 'Vo.Bo. Abg. Jorge Adalid Rodriguez', 0, 1, 'L', false);
/* --- Cell --- */
$pdf->SetXY(129, 270);
$pdf->Cell(0, 4, utf8_decode('Jefe de sección de tramites'), 0, 1, 'L', false);

// for ($i=0; $i <$contarData ; $i++) { 
// $saltolineaPermiso=$saltolineaPermiso+7;


//   $pdf->SetXY(18, $saltolineaPermiso );
//   $pdf->SetFont('Arial','',12);
//   $pdf->Cell(15,6,$data[$i]['cMotivo'],0,1,"L");

//   $pdf->SetXY(77, $saltolineaPermiso );
//   $pdf->Cell(15,6,$data[$i]['fDesde'],0,1,"L");

//   $pdf->SetXY(110, $saltolineaPermiso );
//   $pdf->Cell(15,6,$data[$i]['fHasta'],0,1,"L");


//   $pdf->SetXY(140, $saltolineaPermiso );
//   $pdf->Cell(15,6,$data[$i]['iDias'],0,1,"L");

//    $pdf->SetXY(155, $saltolineaPermiso );
//   $pdf->Cell(15,6,$data[$i]['iHorasDiarias'],0,1,"L");

//   $pdf->SetXY(165, $saltolineaPermiso );
//   $pdf->Cell(15,6,$data[$i]['cMotivo'],0,1,"L");


// }




$pdf->Output();
?>
