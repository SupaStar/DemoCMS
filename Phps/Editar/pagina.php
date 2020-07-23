<?php
include_once("../dbConfig.php");
$idP=$_POST["idP"];
$titulo=$_POST["titulo"];
$url=$_POST["url"];
$contenido=$_POST["contenido"];
renombrarArchivo($cx,$idP,$url);
$sql="update pagina set titulo='$titulo',contenido='$contenido',url='$url' WHERE id=$idP";
$estado=$cx->query($sql);
if($estado){
    crearArchivo($cx,$idP,$url,$contenido);
}
echo json_encode(["estado"=>$estado]);


function renombrarArchivo($cx,$idP,$nUrl){
    $sql="SELECT
    url,
    configuracion.direccion
FROM
    pagina
INNER JOIN configuracion ON pagina.idC = configuracion.id
WHERE
    pagina.id=$idP";
    $data=$cx->query($sql);
    $url="";
    $direccio="";
    foreach ($data as $row){
        $url=$row["url"];
        $direccio=$row["direccion"];
    }
    $oldRuta=$_SERVER['DOCUMENT_ROOT']."/PaginasCreadas/".$direccio."/".$url.".php";
    $newRuta=$_SERVER['DOCUMENT_ROOT']."/PaginasCreadas/".$direccio."/".$nUrl.".php";
    rename ($oldRuta, $newRuta);
}

function crearArchivo($cx,$idP,$url,$contenido){
    $sql="Select idC from pagina WHERE id=$idP";
    $resultado=$cx->query($sql);
    $idC="";
    foreach ($resultado as $row){
        $idC=$row["idC"];
    }
    $sql2="Select direccion,titulo from configuracion WHERE id=$idC";
    $res=$cx->query($sql2);
    $direccion="";
    $titulo="";
    foreach ($res as $row){
        $direccion=$row["direccion"];
        $titulo=$row["titulo"];
    }
    $miArchivo = fopen("../../PaginasCreadas/".$direccion."/".$url.".php", "w") or die("No se puede abrir/crear el archivo!");
    $header="<html><head><meta charset='UTF-8'><meta name='viewport'
content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'><script src=\"/js/bootstrap.min.js\"></script><title>".$titulo."</title></head>";

    $contenidoHTML="<body>".$contenido."</body></html>";
    $htmlCompleto=$header.$contenidoHTML;
    fwrite($miArchivo, $htmlCompleto);
    fclose($miArchivo);
}
