<?php
include_once("../dbConfig.php");
$id=$_POST["id"];
$sql="Delete from configuracion WHERE id=$id";
$estado=$cx->query($sql);
echo json_encode(["estado"=>$estado]);