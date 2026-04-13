<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();


?>

<html lang="es">
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<head>
    <title>Biblioteca</title>


</head>

<body style="background-color:  #F2F2F2;">
<!-- destruccion  -->
<script>
window.onload = function(){killerSession();}
function killerSession(){
setTimeout("window.open('logout.php','_top');",600000);
}
</script>
<!-- destruccion  -->

    <div class="contenedorcabeza">

        <div4>
            <a href="welcome.php"><img src="img/cabezas.png"></a>
        </div4>

        <div2>
            <h1>Buscar por Subtítulo</h1>
        </div2>

        <div1>
            <h2><?php echo 'Bienvenido: <br>' . utf8_decode($row['nombre']); ?>
                <br>
                <br>
                <?php echo 'Matricula: <br>' . utf8_decode($row['usuario']); ?>
                <br>
                <br>
                <a href="logout.php"><img src="img/exit.png"></a>
            </h2>
        </div1>

    </div>



    <center>
        <div id="bus" style="color: blue;">

            <table align="left" border="0">
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="3">
                        <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Subtitulo del Libro">
                    </td>

                    <td colspan="2" align="center">
                        <button class="btn btn-primary" onclick="buscar_ahora($('#buscar').val());">Buscar</button>
                    </td>
                </tr>

            </table>
            <br>
            <br>
            <br>

            <table2>
                <tr>
                    <td colspan="11">
                        <hr size=5 noshade="noshade" color="#052E21">
                    </td>
                </tr>
                <tr>
                    <div class="card col-12 mt-5">
                        <div class="card-body">
                            <div id="datos_buscador" class="container pl-5 pr-5"></div>
                        </div>
                    </div>
                </tr>


        </div>
        </div>
        <tr>
            <script type="text/javascript">
                function buscar_ahora(buscar) {
                    var parametros = {
                        "buscar": buscar
                    };

                    $.ajax({
                        data: parametros,
                        type: 'POST',
                        url: 'buscadorsubt.php',
                        success: function(data) {
                            document.getElementById("datos_buscador").innerHTML = data;
                        }
                    });
                }
                buscar_ahora();
            </script>
        </tr>


        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>


        </div>
        </table2>
        <br>
    </center>
</body>

</html>