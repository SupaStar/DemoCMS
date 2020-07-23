<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php"); //Obtiene la config de la BD
$correo=$_POST["correo"];
$contra=$_POST["contra"];
$sql="select * from usuarios where correo ='$correo'";
$resultados = $cx->query($sql);
if($resultados->num_rows ===0){
	echo json_encode(["estado"=>false,"detalle"=>"Correo o contraseña incorrecta :p"]);
}else{
    $contrabd="";
    $id="";
    foreach ($resultados as $row){
        $contrabd=$row["password"];
        $id=$row["id"];
    }
	if(password_verify ($contra,$contrabd)){
        session_start();
        $_SESSION["usuario"]=$id;
      echo json_encode(["estado"=>true]);
	}else{
		echo json_encode(["estado"=>false,"detalle"=>"Correo o contraseña incorrecta :p"]);
	}
}
?>