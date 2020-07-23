<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
    ?>
<div class="modal fade" id="editarConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar configuracion</h5>
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
                                <input id="tituloPE">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Direccion</span>
                            </td>
                            <td>
                                <input id="direccionPE" type="text">
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <input hidden id="idE">
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEditar()">Guardar</button>
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
    function guardarEditar() {
        var id=$("#idE").val();
        var titulo=$("#tituloPE").val();
        var direccion=$("#direccionPE").val();
        var params={"id":id,"titulo":titulo,"direccion":direccion};
        $.ajax({
            type:"post",
            data:params,
            url: "../Phps/Editar/configuracion.php",
            dataType: 'json',
            success:function (response) {
                if(response.estado){
                    tabla();
                    $("#cerrar").click();
                }
            }
        })
    }
</script>