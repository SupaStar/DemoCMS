<?php
include_once("../dbConfig.php");
$idC=$_POST["idC"];
$sql = "SELECT
    pagina.id,
    pagina.titulo,
    pagina.url,
    pagina.contenido,
    configuracion.direccion
FROM
    pagina
INNER JOIN configuracion ON pagina.idC = configuracion.id
WHERE
    idC =$idC";
$datos=$cx->query($sql);
$arregloPags=[];
foreach ($datos as $row){
    $id=$row["id"];
    $titulo=$row["titulo"];
    $url=$row["url"];
    $contenido=$row["contenido"];
    $direccion=$row["direccion"];
    $var=["id"=>$id,"titulo"=>$titulo,"direccion"=>$url,"contenido"=>$contenido,"carpeta"=>$direccion];
    array_push($arregloPags,$var);
}
echo json_encode(["estado"=>true,"data"=>$arregloPags]);