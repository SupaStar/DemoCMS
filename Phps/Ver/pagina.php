<?php
include_once("../dbConfig.php");
$id=$_GET["id"];
$sql = "Select * from pagina WHERE id=$id";
$datos=$cx->query($sql);
$arregloPags=[];
foreach ($datos as $row){
    $id=$row["id"];
    $titulo=$row["titulo"];
    $url=$row["url"];
    $contenido=$row["contenido"];
    $var=["id"=>$id,"titulo"=>$titulo,"direccion"=>$url,"contenido"=>$contenido];
    array_push($arregloPags,$var);
}
echo json_encode(["estado"=>true,"data"=>$arregloPags]);