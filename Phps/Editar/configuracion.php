<?php
include_once("../dbConfig.php");
$id=$_POST["id"];
$titulo=$_POST["titulo"];
$direccion=$_POST["direccion"];
renombrar($cx,$direccion,$id);
$sql="update configuracion set titulo='$titulo',direccion='$direccion' WHERE id=$id";
$estado=$cx->query($sql);
echo json_encode(["estado"=>$estado]);

function renombrar($cx,$nuevaDir,$id){
    $sql="Select direccion from configuracion WHERE id=$id";
    $data=$cx->query($sql);
    $direccion="";
    foreach ($data as $row){
        $direccion=$row["direccion"];
    }
    $oldRuta=$_SERVER['DOCUMENT_ROOT']."/PaginasCreadas/".$direccion;
    $newRuta=$_SERVER['DOCUMENT_ROOT']."/PaginasCreadas/".$nuevaDir;
    rename ($oldRuta, $newRuta);
}