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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
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
->setCellValue('A1', 'Fiscalia')
->setCellValue('B1', 'Delito')
->setCellValue('C1', 'Lugar de hecho')
->setCellValue('D1', 'Fecha Hecho')
->setCellValue('E1', 'Sexo del Ofendido')
->setCellValue('F1', 'Edad Ofendido')
->setCellValue('G1', 'Edad Imputado')
->setCellValue('H1', 'Sexo Imputado')
->setCellValue('I1', 'Ocupacion Imputado');



// Miscellaneous glyphs, UTF-8

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
