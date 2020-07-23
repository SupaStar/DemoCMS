<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
switch ($_POST["funcion"]) {
    case 1:
        datosP($cx);
        break;
    case 2:
        correo($cx);
        break;
    case 3:
        password($cx);
        break;
}
function datosP($cx)
{
    $nombre = $_POST["nombre"];
    $apPat = $_POST["apPat"];
    $apMat = $_POST["apMat"];
    $id = $_SESSION["usuario"];
    $sql = "Update usuarios set nombre='$nombre',apPaterno='$apPat',apMaterno='$apMat' WHERE id='$id'";
    $result = $cx->query($sql);
    echo json_encode(["estado" => $result]);
}

function correo($cx)
{
    $id = $_SESSION["usuario"];
    $correo = $_POST["correo"];
    $sql = "Update usuarios set correo='$correo' WHERE id='$id'";
    $result = $cx->query($sql);
    echo json_encode(["estado" => $result]);
}

function password($cx)
{
    $paswordA = $_POST["passA"];
    $paswordN = $_POST["passN"];
    $id = $_SESSION["usuario"];
    $contrabd = "";
    $sql = "select password from usuarios WHERE  id='$id'";
    $result = $cx->query($sql);
    foreach ($result as $row) {
        $contrabd = $row["password"];
    }
    if (password_verify($paswordA, $contrabd)) {
        $passNHash = password_hash($paswordN, PASSWORD_DEFAULT);
        $sqlN = "Update usuarios set password='$passNHash' WHERE id='$id'";
        $response = $cx->query($sqlN);
        echo json_encode(["estado" => $response]);
    } else {
        echo json_encode(["estado" => false]);
    }
}
