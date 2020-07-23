<?php 
require_once ("../dbConfig.php");
session_start();
$id=$_SESSION["usuario"];
$sql="SELECT recursos.ruta FROM usuarios INNER JOIN recursos ON usuarios.id = recursos.id WHERE usuarios.id =$id";
$recurso="";
$datos=$cx->query($sql);
foreach ($datos as $row) {
        $recurso = $row["ruta"];
    }
    if($recurso==""){
$dir = $_SERVER["DOCUMENT_ROOT"] . "/imagenes";
    $img = $_FILES["imagen"];
    $fileNameUsr = $_FILES['imagen']['name'];
    $tmp_name = $_FILES['imagen']['tmp_name'];
    $filename = $fileNameUsr;
    $direccionFinal = $_SERVER["DOCUMENT_ROOT"] . "/imagenes/" . $filename;
    if (is_dir($dir) && is_uploaded_file($tmp_name)) {
        move_uploaded_file($tmp_name, $dir . '/' . $filename);
    }
    $sql = "INSERT INTO recursos VALUES (null,'$filename','$id')";
    $estado=$cx->query($sql);
    echo json_encode(["estado"=>$estado,"img"=>$filename]);
}else{
	$dir = $_SERVER["DOCUMENT_ROOT"] . "/imagenes";
    $img = $_FILES["imagen"];
    $fileNameUsr = $_FILES['imagen']['name'];
    $tmp_name = $_FILES['imagen']['tmp_name'];
    $filename = $fileNameUsr;
    $direccionFinal = $_SERVER["DOCUMENT_ROOT"] . "/imagenes/" . $filename;
    if (is_dir($dir) && is_uploaded_file($tmp_name)) {
        move_uploaded_file($tmp_name, $dir . '/' . $filename);
    }
    $sql = "update recursos set ruta='$filename' WHERE id=$id";
    $estado=$cx->query($sql);
    echo json_encode(["estado"=>$estado,"img"=>$filename]);
}
?>