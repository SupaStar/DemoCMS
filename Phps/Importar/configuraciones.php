<?php
$excel = $_FILES["archivo"];
$dir = $_SERVER["DOCUMENT_ROOT"] . "/Exceles";
$fileNameUsr = $_FILES['archivo']['name'];
$tmp_name = $_FILES['archivo']['tmp_name'];
$filename = $fileNameUsr;
$direccionFinal = $_SERVER["DOCUMENT_ROOT"] . "/exceles/" . $filename;
if (is_dir($dir) && is_uploaded_file($tmp_name)) {
    move_uploaded_file($tmp_name, $dir . '/' . $filename);
}
require_once $_SERVER["DOCUMENT_ROOT"].'/Phps/PHPExcel.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/Phps/dbConfig.php';
$inputFileType = PHPExcel_IOFactory::identify($direccionFinal);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($direccionFinal);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
for ($row = 2; $row <= $highestRow; $row++) {
    $titulo = $sheet->getCell("A" . $row)->getValue();
    $direccion = $sheet->getCell("B" . $row)->getValue();
    $idU = $sheet->getCell("C" . $row)->getValue();
    $sql="Insert into configuracion VALUES (null,'$titulo','$direccion',$idU)";
    mkdir("../../PaginasCreadas/".$direccion, 0777);
    $cx->query($sql);
}