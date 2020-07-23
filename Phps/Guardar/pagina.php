<?php
include_once ("../dbConfig.php");
$titulo=$_POST["titulo"];
$url=$_POST["url"];
$idC=$_POST["idC"];
$contenido=$_POST["contenido"];
$sql="insert into pagina VALUES (null,'$titulo','$url','$contenido',$idC)";
$estado=$cx->query($sql);
if($estado){
    $sql2="Select direccion,titulo from configuracion WHERE id=$idC";
    $res=$cx->query($sql2);
    $direccion="";
    $titulo="";
    foreach ($res as $row){
        $direccion=$row["direccion"];
        $titulo=$row["titulo"];
    }
    $miArchivo = fopen("../../PaginasCreadas/".$direccion."/".$url.".php", "w+") or die("No se puede abrir/crear el archivo!");
    $header="<html><head><meta charset='UTF-8'><meta name='viewport'
content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'><script src=\"/js/bootstrap.min.js\"></script><title>".$titulo."</title></head>";

    $contenidoHTML="<body>".$contenido."</body></html>";
    $htmlCompleto=$header.$contenidoHTML;
    fwrite($miArchivo, $htmlCompleto);
    fclose($miArchivo);
}

echo json_encode(["estado"=>$estado]);
