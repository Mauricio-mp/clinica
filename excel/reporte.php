<?php 
session_start();
ob_start();





// error_reporting(E_ALL);
 //  ini_set('display_errors', '1');
require "../Classes/PHPExcel.php";
require "../Classes/PHPExcel/Writer/Excel5.php"; 
header('Content-Type: text/html; charset=ISO-8859-1');


$var=$_SESSION['reporte'];

$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Govinda")
                             ->setLastModifiedBy("Govinda")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");

// Add some data
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);


$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("G1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("H1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("I1")->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Mes')
->setCellValue('B1', 'Administracion de Medicamentos')
->setCellValue('C1', 'Nebulizaciones')
->setCellValue('D1', 'Bendajes')
->setCellValue('E1', 'Lavado de Oidos')
->setCellValue('F1', 'Toma de PA')
->setCellValue('G1', 'Toma de CLU')
->setCellValue('H1', 'Consultas Medicas')
->setCellValue('I1', 'Total Atenciones');



// Miscellaneous glyphs, UTF-8
/*
$cont=2;
$total=0;
for ($i=0; $i <count($var) ; $i++) { 
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cont, $var[$i]['fiscalia']);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cont, $var[$i]['delito']);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cont, $var[$i]['lugarhecho']);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cont, $var[$i]['fechahecho']);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cont, $var[$i]['sexoofendido']);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cont, $var[$i]['edadofendido']);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$cont, $var[$i]['edadimputado']);
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$cont, $var[$i]['sexoimputado']);
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$cont, $var[$i]['ocupacionimputado']);
	$cont++;
}
    
*/
$objPHPExcel->getActiveSheet()->SetCellValue(A2.$cont, 'Junio');
$objPHPExcel->getActiveSheet()->SetCellValue(B2.$cont, 125);
$objPHPExcel->getActiveSheet()->SetCellValue(C2.$cont, 75);
$objPHPExcel->getActiveSheet()->SetCellValue(D2.$cont, 16);
$objPHPExcel->getActiveSheet()->SetCellValue(E2.$cont, 2);
$objPHPExcel->getActiveSheet()->SetCellValue(F2.$cont, 8);
$objPHPExcel->getActiveSheet()->SetCellValue(G2.$cont, 2);
$objPHPExcel->getActiveSheet()->SetCellValue(H2.$cont, 15);
$objPHPExcel->getActiveSheet()->SetCellValue(I2.$cont, 133);



$objPHPExcel->getActiveSheet()->SetCellValue(A3.$cont, 'Julio');
$objPHPExcel->getActiveSheet()->SetCellValue(B3.$cont, 125);
$objPHPExcel->getActiveSheet()->SetCellValue(C3.$cont, 75);
$objPHPExcel->getActiveSheet()->SetCellValue(D3.$cont, 23);
$objPHPExcel->getActiveSheet()->SetCellValue(E3.$cont, 8);
$objPHPExcel->getActiveSheet()->SetCellValue(F3.$cont, 2);
$objPHPExcel->getActiveSheet()->SetCellValue(G3.$cont, 98);
$objPHPExcel->getActiveSheet()->SetCellValue(H3.$cont, 8);
$objPHPExcel->getActiveSheet()->SetCellValue(I3.$cont, 222);

$objPHPExcel->getActiveSheet()->SetCellValue(A4.$cont, 'Agosto');
$objPHPExcel->getActiveSheet()->SetCellValue(B4.$cont, 125);
$objPHPExcel->getActiveSheet()->SetCellValue(C4.$cont, 75);
$objPHPExcel->getActiveSheet()->SetCellValue(D4.$cont, 8);
$objPHPExcel->getActiveSheet()->SetCellValue(E4.$cont, 8);
$objPHPExcel->getActiveSheet()->SetCellValue(F4.$cont, 2);
$objPHPExcel->getActiveSheet()->SetCellValue(G4.$cont, 4);
$objPHPExcel->getActiveSheet()->SetCellValue(H4.$cont, 2);
$objPHPExcel->getActiveSheet()->SetCellValue(I4.$cont, 99);
  





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="userList.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>
