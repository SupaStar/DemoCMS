<!doctype html>
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
        <li class="breadcrumb-item"><a href="/index.php">Login</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registro</li>
    </ol>
</nav>
<div class="contenido">
    <div class="container">
        <h2 class="text-center">Registro</h2>
    </div>
    <form method="post" action="#">
        <div id="error" class="alert alert-danger oculto" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p id="msjE"></p>
        </div>
        <div class="alert alert-secondary" role="alert">
            <span>Los campos con * son obligatorios.</span>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td>
                    <div>
                        <span class="input-group-text">Introduce tu nombre(s)*:</span>
                    </div>
                </td>
                <td class="inputsReg">
                    <input id="nombre" name="nombre" type="text" required class="form-control"
                           onkeyup="this.value=soloLetras(this.value)">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="input-group-text">Apellido paterno</span>
                </td>
                <td>
                    <input id="apPaterno" type="text" required class="form-control"
                           onkeyup="this.value=soloLetras(this.value)">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Apellido materno</span></td>
                <td><input id="apMaterno" type="text" required class="form-control"
                           onkeyup="this.value=soloLetras(this.value)">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Introduce tu correo electronico *:</span></td>
                <td>
                    <input id="correo" type="email"
                           required class="form-control">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Introduce tu contraseña *:</span></td>
                <td>
                    <input id="password" required type="password" class="form-control" aria-label="Contraseña"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Repite tu contraseña *:</span></td>
                <td>
                    <input id="rpassword" type="password" class="form-control" aria-label="RContraseña"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            </tbody>
        </table>
        <div align="center">
            <button id="enviar" class="btn btn-primary btn-lg btn-block" onclick="registroUsu()" type="button">
                Registrarse
            </button>
            <input type="reset" class="btn btn-secondary btn-lg btn-block">
            <div class="dropdown-divider"></div>
            <a href="/index.php" class="dropdown-item text-success">¿Ya te has registrado? Haz click aqui para iniciar
                sesion.</a>
        </div>
        <div id="alert" class="alert alert-success oculto" role="alert">
            <h4 class="alert-heading">Exito!</h4>
            <p>Te has registrado con exito,ahora puedes iniciar sesion</p>
        </div>
    </form>
</div>
</div>
<p></p><br>
    <?php
        require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Plantillas/footer.php');
    ?>
</body>
</html>
<script>
    function soloLetras(string) {
        var out = '';
        //Se añaden las letras validas
        var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ';//Caracteres validos

        for (var i = 0; i < string.length; i++)
            if (filtro.indexOf(string.charAt(i)) != -1)
                out += string.charAt(i);
        return out;
    }
    function registroUsu() {
        var mensajeE = $("#msjE");
        var nombre, correo;
        nombre = document.getElementById("nombre").value;
        if (nombre === "") {
            mensajeE.empty();
            mensajeE.append("Debes colocar tu nombre.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        correo = document.getElementById("correo");
        if (correo.validity.typeMismatch||correo==="") {
            mensajeE.empty();
            mensajeE.append("Debes colocar tu correo electronico con el formato correcto.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        var password = document.getElementById("password").value,
            rpasword = document.getElementById("rpassword").value;
        if (password.length < 8 || rpasword.length < 8) {
            mensajeE.empty();
            mensajeE.append("La contraseña debe tener minimo 8 caracteres.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        if (password !== rpasword) {
            mensajeE.empty();
            mensajeE.append("Las contraseñas deben coincidir");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
        } else {
            var parametros = {
                "nombre": nombre,
                "apPaterno": document.getElementById("apPaterno").value,
                "apMaterno": document.getElementById("apMaterno").value,
                "correo": correo.value,
                "password": password
            };
            $.ajax({
                data: parametros,
                url: '/Phps/Perfil/registro.php',
                type: 'post',
                beforeSend: function () {
                    $('#rpassword').popover('dispose');
                    $('#enviar').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.estado) {
                        document.getElementById("alert").style.display = "block";
                        $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
                        setTimeout(function () {
                            document.getElementById("alert").style.display = "none";
                        }, 7000);
                        limpiarReg();
                    } else {
                        mensajeE.empty();
                        mensajeE.append("Ah ocurrido un error al registrarte");
                        document.getElementById("error").style.display = "block";
                        $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
                        setTimeout(function () {
                            document.getElementById("error").style.display = "none";
                        }, 7000);
                    }
                }
            });
        }
    }
    function limpiarReg() {
        document.getElementById("nombre").value = "";
        document.getElementById("apPaterno").value = "";
        document.getElementById("apMaterno").value = "";
        document.getElementById("correo").value = "";
        document.getElementById("password").value = "";
        document.getElementById("rpassword").value = "";
    }
</script>
<?php }
else {
    header('location:/index.php');
} ?>