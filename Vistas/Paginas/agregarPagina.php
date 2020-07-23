<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
include_once($_SERVER['DOCUMENT_ROOT'] . "/Phps/dbConfig.php");
include("../Plantillas/head.php");
include("../Plantillas/header.php");
$id = $_GET["idC"];
?>
<script src="/ckeditor/ckeditor.js"></script>
<body>
<div class="container">
    <?php include("../Plantillas/menu.php"); ?>
    <div>
        <span>Titulo</span>
        <input id="titulo" class="form-control">
    </div>
    <div>
        <span>URL</span>
        <input id="url" class="form-control">
    </div>
    <div>
        <span>Contenido</span>
        <textarea id="contenidoT"></textarea>
    </div>
    <input id="confgId" value="<?php echo $id?>" hidden><p></p>
    <button class="btn btn-outline-primary" type="button" onclick="guardar()">Guardar</button>
</div><p></p>
<?php include("../Plantillas/footer.php"); ?>
</body>
<?php
}else{
    header('location:/index.php');
}
?>
<script>
    var editor = CKEDITOR.replace('contenidoT');
    function guardar() {
        var titulo = $("#titulo").val();
        var url = $("#url").val();
        var idC = $("#confgId").val();
        var content = editor.getData();
        var params = {"titulo": titulo, "url": url, "contenido": content, "idC": idC};
        $.ajax({
            type: "Post",
            data: params,
            url: "../../Phps/Guardar/pagina.php",
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    location.href='paginasConfig.php?id='+idC;
                }
            }
        });
    }
</script>
</html>