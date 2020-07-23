<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
include_once($_SERVER['DOCUMENT_ROOT'] . "/Phps/dbConfig.php");
$id = $_GET["id"];
include("../Plantillas/head.php");
include("../Plantillas/header.php");
?>
<body>
<div class="container">
    <?php include("../Plantillas/menu.php"); ?>
    <div class="row">
        <div class="col-lg-3">
            <a class="btn btn-block btn-outline-primary" href="agregarPagina.php?idC=<?php echo $id?>">Agregar</a>
            <div>
                <a class="btn btn-block btn-outline-success" target="_blank" href="../pdfs/paginas.php?idC=<?php echo $id?>">Pdf</a>
            </div>
            <input id="configId" value="<?php echo $id?>" hidden>
        </div>
        <div class="col-lg-8 ofset-lg-1">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="cuerpoT"></tbody>
            </table>
        </div>
    </div>
</div>
<p></p><br>
<?php
include("../Plantillas/footer.php");
?>
</body>
<?php
}else{
    header('location:/index.php');
}
?>
<script>
    function verPaginas() {
        var idC = $("#configId").val();
        $.ajax({
            type: "post",
            data: {"idC": idC},
            url: "../../Phps/Ver/paginas.php",
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    var datos = response.data;
                    $("#cuerpoT").html("");
                    datos.forEach(function (data) {
                        $("#cuerpoT").append("<tr><td>" + data.id + "</td><td>" + data.titulo + "</td><td>" +
                            "<a href='editarPagina.php?idP="+data.id+"&idC="+idC+"' class='btn'><i class='fas fa-pencil-alt'></i></a>" +
                            "<a href='/PaginasCreadas/"+data.carpeta+"/"+data.direccion+".php' target='_blank'><i class='fas fa-eye'></i></a></td></tr>");
                    });
                }
            }
        });
    }
    verPaginas();
</script>
</html>