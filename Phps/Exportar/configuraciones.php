<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Phps/PHPExcel.php" ;
include_once $_SERVER["DOCUMENT_ROOT"]."/Phps/dbConfig.php" ;
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
    ->setCreator("Obed&Itzel")
    ->setLastModifiedBy("Obed&Itzel")
    ->setTitle("Configuraciones Exportadas")
    ->setSubject("Documento Excel")
    ->setDescription("Configuraciones que fueron exportadas")
    ->setKeywords("")
    ->setCategory("Configuraciones");
$sql="select * from configuracion";
$datos=$cx->query($sql);
$numero=2;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Titulo')
    ->setCellValue('B1', 'Direccion')
    ->setCellValue('C1', 'idU')
;
while($r=$datos->fetch_array()){
    $titulo=$r["titulo"];
    $direccion=$r["direccion"];
    $idU=$r["idU"];
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$numero, $titulo)
        ->setCellValue('B'.$numero, $direccion)
        ->setCellValue('C'.$numero, $idU)
    ;
    $numero++;
}

// indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Configuraciones.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');