<?php 
session_start();
ob_start();





// error_reporting(E_ALL);
 //  ini_set('display_errors', '1');
require "../Classes/PHPExcel.php";
require "../Classes/PHPExcel/Writer/Excel5.php"; 
header('Content-Type: text/html; charset=ISO-8859-1');

$motivos=$_SESSION['motivos'];
$datos=$_SESSION['valores'];



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
function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}

$activeSheet = $objPHPExcel->getActiveSheet();
    //..
    //...
$activeSheet->getStyle("A")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("B")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("C")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("D")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("E")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("F")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("G")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("H")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("I")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("J")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle("k")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

cellColor('A1', '3498DB');
cellColor('B1', '3498DB');
cellColor('C1', '3498DB');
cellColor('D1', '3498DB');
cellColor('E1', '3498DB');
cellColor('F1', '3498DB');
cellColor('G1', '3498DB');
cellColor('H1', '3498DB');
cellColor('I1', '3498DB');
cellColor('J1', '3498DB');
cellColor('k1', '3498DB');


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);

$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("G1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("H1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("I1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("J1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("K1")->getFont()->setBold(true);



	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'MES')
->setCellValue('B1', $motivos[0]['cnombre'])
->setCellValue('C1', $motivos[1]['cnombre'])
->setCellValue('D1', $motivos[2]['cnombre'])
->setCellValue('E1', $motivos[3]['cnombre'])
->setCellValue('F1', $motivos[4]['cnombre'])
->setCellValue('G1', $motivos[5]['cnombre'])
->setCellValue('H1', $motivos[6]['cnombre'])
->setCellValue('I1', $motivos[7]['cnombre'])
->setCellValue('J1', $motivos[8]['cnombre'])
->setCellValue('K1', 'Total');





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
$cont=2;
$sumador=0;
for ($j=0; $j <count($datos) ; $j++) { 
$sumador=$datos[$j]['suma']+$sumador;
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$cont, $datos[$j]['mes']);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$cont, $datos[$j][0]);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$cont, $datos[$j][1]);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$cont, $datos[$j][2]);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$cont, $datos[$j][3]);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$cont, $datos[$j][4]);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$cont, $datos[$j][5]);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$cont, $datos[$j][6]);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$cont, $datos[$j][7]);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$cont, $datos[$j][8]);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$cont, $datos[$j]['suma']);

$cont++;
}

$objPHPExcel->getActiveSheet()->SetCellValue('K'.$cont, number_format($sumador,2));


  

// print_r('<pre>');
// print_r($datos);
// print_r('</pre>');


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="Reporte_Mensual_Clinica.xls"');
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
