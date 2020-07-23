<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
$id=$_SESSION["usuario"];
include("Plantillas/head.php");
include("Plantillas/header.php");
?>
<body>
<?php
include ("Modales/editarConfiguracion.php");
include ("Modales/agregarConfig.php");
?>
<div class="container">
<?php include("Plantillas/menu.php"); ?>
<div class="row">
    <div class="col-lg-3">
        <button type="button" class="btn btn-outline-primary  btn-block" data-toggle='modal' data-target='#agregarConfig'>Agregar</button>
       
        <div>
            <a class="btn btn-outline-success btn-block" target="_blank" href="pdfs/configuraciones.php?idU=<?php echo $_SESSION["usuario"] ?>">Pdf</a>
        </div>
    </div>
    <div class="col-lg-8 ofset-lg-1">
        <div align="right">
            <label><small>Importar configuraciones</small></label><br>
            <input type="file" id="archivoI" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <button class="btn btn-outline-success btn-sm" type="button" onclick="importar()">Importar</button>
        </div><br><p></p>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Titulo Web</th>
                <th>Url Web</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="tbody"></tbody>
        </table>
        <div align="right">
            <button class="btn btn-outline-success btn-sm" type="button" onclick="exportar()">Exportar</button>
        </div>
    </div>
</div>
</div>
<p></p><br>
<?php
include("Plantillas/footer.php");
?>
</body>
<?php
}else{
    header('location:/index.php');
}
?>
<script>
    function importar() {
        var archivo = document.getElementById('archivoI');
        var excel = new FormData();
        excel.append("archivo", archivo.files[0]);
        $.ajax({
            type: "post",
            data: excel,
            url: "/Phps/Importar/configuraciones.php",
            processData: false,
            contentType: false,
            cache: false,
            success: function () {
                tabla();
            }
        });
    }
    function exportar() {
        $.ajax({
            type: "get",
            url: "../Phps/Exportar/configuraciones.php",
            success:function (response) {
                window.open('../Phps/Exportar/configuraciones.php');
            }
        });

    }
    function tabla() {
        var idU = $("#idU").val();
        $.ajax({
            type: "get",
            url: "../Phps/Ver/configuraciones.php?id="+idU,
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    var datos = response.data;
                    $("#tbody").html("");
                    datos.forEach(function (data) {
                        $("#tbody").append("<tr><td>" + data.id + "</td><td>" + data.titulo + "</td>" +
                            "<td>" + data.direccion + "</td>" +
                            "<td><a target='_blank' href='Paginas/paginasConfig.php?id="+data.id+"' class='btn'><i class='fas fa-search'></i></a>" +
                            "<button type='button' onclick='verEditar(" + data.id + ")' class='btn' data-toggle='modal' data-target='#editarConfig'><i class='fas fa-pencil-alt'></i></button>" +
                            "<button type='button' onclick='eliminar(" + data.id + ")' class='btn'><i class='fas fa-trash'></i></button>" +
                            "</td></tr>");
                    });
                }
            }
        });
    }
    function verEditar(id) {
        $("#idE").val(id);
        $.ajax({
            type: "get",
            url: "../Phps/Ver/configuracion.php?id="+id,
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    var datos = response.data[0];
                    $("#tituloPE").val(datos.titulo);
                    $("#direccionPE").val(datos.direccion);
                }
            }
        });
    }
    function eliminar(id) {
        var params = {"id": id};
        $.ajax({
            type: "post",
            data: params,
            url: "../Phps/Eliminar/configuracion.php",
            dataType: 'json',
            success: function (response) {
                if (response.estado) {
                    tabla();
                }
            }
        });
    }
    tabla();
</script>
</html>