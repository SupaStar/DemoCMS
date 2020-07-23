<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
    ?>
<div class="modal fade" id="agregarConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar configuracion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend>Configuración</legend>
                    <table>
                        <tr>
                            <td>
                                <span>Titulo web</span>
                            </td>
                            <td>
                                <input id="tituloP">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Direccion</span>
                            </td>
                            <td>
                                <input id="direccionP" type="text">
                                <input id="idU" value="<?php echo $id ?>" hidden>

                            </td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    header('location:/index.php');
}
?>
<script>
    function guardar() {
        var titulo = $("#tituloP").val();
        var direccion = $("#direccionP").val();
        var idU = $("#idU").val();
        var params = {"titulo": titulo, "direccion": direccion,"idU":idU};
        $.ajax({
            type: "post",
            data: params,
            url: "../Phps/Guardar/configuracion.php",
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    location.href='verConfigs.php';
                }
            }
        })
    }

</script>