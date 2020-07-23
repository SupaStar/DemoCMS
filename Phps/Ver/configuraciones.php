<?php
include_once("../dbConfig.php");
$idU=$_GET["id"];
$sql = "Select * from configuracion WHERE idU=$idU";
$datos=$cx->query($sql);
$arregloConfigs=[];
foreach ($datos as $row){
 $id=$row["id"];
 $titulo=$row["titulo"];
 $direccion=$row["direccion"];
 $var=["id"=>$id,"titulo"=>$titulo,"direccion"=>$direccion];
 array_push($arregloConfigs,$var);
}
echo json_encode(["estado"=>true,"data"=>$arregloConfigs]);