<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre, id_tipo FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();

$consulta = "SELECT *
            FROM negados";
$buscador = mysqli_query($mysqli, $consulta);
$numero = mysqli_num_rows($buscador);
$contador = 1;

?>

<html lang="es">
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<head>
    <title>Biblioteca</title>


</head>

<body style="background-color:  #F2F2F2;">

    <?php
    if ($row['id_tipo'] == 1) {

    ?>


        <!-- destruccion  -->
        <script>
            window.onload = function() {
                killerSession();
            }

            function killerSession() {
                setTimeout("window.open('logout.php','_top');", 600000);
            }
        </script>
        <!-- destruccion  -->



        <div class="contenedorcabeza">

            <div4>
                <a href="welcome.php"><img src="img/cabezas.png"></a>
            </div4>

            <div2>
                <h1>Historial de Prestamos Rechazados</h1>
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


        <table border="0" align="center">

        <tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<form method="POST" name="rechazados" id="rechazados" action="tablarechazados.php" target="_blank">

<td align="right" colspan="35">
            <input type="submit" name="imprimir" value="Imprimir Reporte Completo"> 
</td>
</form>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>

            <tr align="center">
                <th align="center">
                    <h6> N°</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Título</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Folio</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Ubicación</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Nombre del Solicitante</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Matricula del Solicitante</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Fecha de Solicitud</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Nota</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Fecha de Cancelación</h6>
                </th>
                <th></th>
                <th></th>
                <th align="center">
                    <h6> Imprimir Reporte</h6>
                </th>
            </tr>
            <tr>
                <td colspan="35">
                    <hr size=5 noshade="noshade" color="#052E21">
                </td>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($buscador)) { ?>
                <form method="POST" name="imprimirprestados" id="imprimirprestados" action="imprrechazado.php" target="_blank">

                    <input id="tit" name="tit" type="hidden" value="<?php echo $row['titulo']; ?>">
                    <input id="fol" name="fol" type="hidden" value="<?php echo $row['folio']; ?>">
                    <input id="nos" name="nos" type="hidden" value="<?php echo $row['nombresoli']; ?>">
                    <input id="mas" name="mas" type="hidden" value="<?php echo $row['matriculasoli']; ?>">
                    <input id="fes" name="fes" type="hidden" size="10" value="<?php echo $row['fechaPedido']; ?>">
                    <input id="mot" name="mot" type="hidden" value="<?php echo $row['motivo']; ?>">
                    <input id="fec" name="fec" type="hidden" value="<?php echo $row['fecha']; ?>">




                    <tr>
                        <td align="center"><?php echo $contador++; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['titulo']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['folio']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['nombresoli']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['matriculasoli']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php 
                        
                        echo str_replace('-', '/', date('d-m-Y', strtotime($row['fechaPedido']))); 
                        
                        ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php echo $row['motivo']; ?></td>
                        <td></td>
                        <td></td>
                        <td align="center"><?php 
                        
                        echo str_replace('-', '/', date('d-m-Y', strtotime($row['fecha']))); 
                        
                        ?></td>
                        <td></td>
                        <td></td>
                        <td align="center">
                            <input type="submit" name="imprimir" value="Imprimir">
                        </td>
                        </form>
                    </tr>
                    <tr>
                        <td colspan="35">
                            <hr size=1 noshade="noshade" color="#052E21">
                        </td>

                    </tr>




                <?php } ?>
                
        </table>


    <?php
    }

    ?>
</body>

</html>