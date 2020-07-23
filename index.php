<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["usuario"])){
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Plantillas/head.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Plantillas/header.php');
?>
<div class="container">

    <nav aria-label="breadcrumb" class="padBod">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="/loginRene/index.php">Login</a></li>
        </ol>
    </nav>

    <div class="contenido">
        <div id="error" class="alert alert-danger oculto" role="alert" align="center">
            <h4 class="alert-heading">Error!</h4>
            <p id="msjE"></p>
        </div>
        <div class="container">
            <h2 class="text-center">Login</h2>
        </div>
        <form class="px-4 py-3">
            <div class="form-group">
                <label for="Correo">Correo electronico</label>
                <input id="correoelec" type="email" class="form-control" placeholder="email@example.com">
            </div>
            <div class="form-group">
                <label for="Contraseña">Contraseña</label>
                <input id="password" type="password" class="form-control" placeholder="Introduce tu contraseña">
            </div>
            <button type="button" onClick="prueba()" class="btn btn-primary">Inicia sesion</button>
            <input type="reset" class="btn btn-secondary">
        </form>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-success" href="/Vistas/vistaRegistro.php">Nuevo aqui? Crea una cuenta</a>
    </div>
</div><p></p><br>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Plantillas/footer.php');
    ?>
</body>
</html>
<script type="text/javascript">
    function prueba() {
        var correoelec = document.getElementById("correoelec");
        var password = document.getElementById("password").value;
        if (!correoelec.validity.typeMismatch) {
            var param = {
                "correo": correoelec.value,
                "contra": password
            };
            $.ajax({
                data: param,
                url: "/Phps/Perfil/login.php",
                type: "post",
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.estado) {
                        window.location = "/Vistas/Perfiles/editarPerfil.php";
                    } else {
                        $("#msjE").empty();
                        $("#msjE").append(json.detalle);
                        document.getElementById("error").style.display = "block";
                        setTimeout(function () {
                            document.getElementById("error").style.display = "none";
                        }, 7000);
                        window.scrollTo(0, 0);
                    }
                }
            });
        }else{
            $("#msjE").empty();
            $("#msjE").append("Formato de correo electronico erroneo.");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
        }
    }

</script>
<?php }
else {
    header('location:/Vistas/Perfiles/editarPerfil.php');
} ?>
