<?php
include_once ("../dbConfig.php");
$titulo=$_POST["titulo"];
$direccion=$_POST["direccion"];
$idU=$_POST["idU"];
$sql="Insert into configuracion VALUES (null,'$titulo','$direccion',$idU)";
$estado=$cx->query($sql);
echo json_encode(["estado"=>$estado]);
mkdir("../../PaginasCreadas/".$direccion, 0777);