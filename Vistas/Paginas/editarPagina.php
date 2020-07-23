<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
include_once($_SERVER['DOCUMENT_ROOT'] . "/Phps/dbConfig.php");
include("../Plantillas/head.php");
include("../Plantillas/header.php");
$idP = $_GET["idP"];
$idC = $_GET["idC"];
?>
<script src="/ckeditor/ckeditor.js"></script>
<body>
<div class="container">
    <?php include("../Plantillas/menu.php"); ?>
    <div>
        <span>Titulo</span>
        <input id="tituloE" class="form-control">
    </div>
    <div>
        <span>URL</span>
        <input id="urlE" class="form-control">
    </div>
    <div>
        <span>Contenido</span>
        <textarea id="contenidoTE"></textarea>
    </div>
    <input id="idPag" value="<?php echo $idP?>" hidden>
    <input id="idC" value="<?php echo $idC?>" hidden><p></p>
    <button class="btn btn-outline-primary" type="button" onclick="guardar()">Guardar</button>
</div>
</body><p></p>
<?php include("../Plantillas/footer.php"); ?>
<?php
}else{
    header('location:/index.php');
}
?>
<script>
    var editor = CKEDITOR.replace('contenidoTE');
    function guardar() {
        var titulo = $("#tituloE").val();
        var url = $("#urlE").val();
        var idP = $("#idPag").val();
        var idC = $("#idC").val();
        var content = editor.getData();
        var params = {"titulo": titulo, "url": url, "contenido": content, "idP": idP};
        $.ajax({
            type: "Post",
            data: params,
            url: "../../Phps/Editar/pagina.php",
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    location.href='paginasConfig.php?id='+idC;
                }
            }
        });
    }
    function llenar() {
        var idP = $("#idPag").val();
        $.ajax({
            type: "get",
            url: "../../Phps/ver/pagina.php?id="+idP,
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    var data=response.data[0];
                    $("#tituloE").val(data.titulo);
                    $("#urlE").val(data.direccion);
                    $("#contenidoTE").val(data.contenido);
                }
            }
        });
    }
    llenar();
</script>
</html>
