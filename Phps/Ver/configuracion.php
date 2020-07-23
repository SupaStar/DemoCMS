<?php
include_once("../dbConfig.php");
$id = $_GET["id"];
$sql = "select * from configuracion WHERE id=$id";
$data = $cx->query($sql);
$arregloDatos = [];
foreach ($data as $row) {
    $id = $row["id"];
    $titulo = $row["titulo"];
    $direccion = $row["direccion"];
    $var = ["id" => $id, "titulo" => $titulo, "direccion" => $direccion];
    array_push($arregloDatos, $var);
}
echo json_encode(["estado" => true, "data" => $arregloDatos]);