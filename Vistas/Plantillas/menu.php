<?php 
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
 ?>
<div id="menu" class="meni" style="background-image: linear-gradient( 33.2deg,  rgba(157,147,247,1) 30.2%, rgba(117,176,247,1) 61.4% );; color: #b9bbbe;">
    <div class="row">
        <div class="col-lg-6">
            <ul class="nav" >
                <li class="nav-item">
                    <a class="nav-link active" href="/Vistas/Perfiles/editarPerfil.php" style="color: white">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Vistas/verConfigs.php?id=<?php echo $_SESSION["usuario"] ?>" style="color: white">Configuraciones</a>
                </li>
                
            </ul>
        </div>
        <div class="col-lg-6">
            <div align="right"><a href="/Phps/Perfil/cerrarSesion.php" class="btn" style="color: white">Cerrar Sesión</a></div>
        </div>
    </div>
</div><p></p><br>