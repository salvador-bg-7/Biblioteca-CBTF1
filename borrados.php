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
            FROM librosborrados";
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
                <h1>Historial de Libros Borrados</h1>
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


        <table border="0">


        <tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<form method="POST" name="borrados" id="borrados" action="tablaborrados.php" target="_blank">

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
                <th>
                    <h6> N°</h6>
                </th>
                <th>
                    <h6> Título</h6>
                </th>
                <th>
                    <h6> Subtitulos</h6>
                </th>
                <th>
                    <h6> Autor</h6>
                </th>
                <th>
                    <h6> Editorial</h6>
                </th>
                <th>
                    <h6> Edición</h6>
                </th>
                <th>
                    <h6> Categoría</h6>
                </th>
                <th>
                    <h6> Motivo</h6>
                </th>
                <th>
                    <h6> Páginas</h6>
                </th>
                <th>
                    <h6> Ubicación</h6>
                </th>
                <th>
                    <h6> Folio</h6>
                </th>
                <th>
                    <h6> Fecha</h6>
                </th>
                <th>
                    <h6> Imprimir</h6>
                </th>
            </tr>
            <tr>
                <td colspan="13">
                    <hr size=5 noshade="noshade" color="#052E21">
                </td>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($buscador)) {

                switch ($row['disponibilidad']) {
                    case 0:
                        $row['disponibilidad'] = "Disponible <br>😊";
                        break;

                    case 1:
                        $row['disponibilidad'] = "No disponible <br>😢";
                        break;
                }

            ?>
                <form method="POST" action="imprborrado.php" target="_blank">
                    
                    <input id="tit" name="tit" type="hidden" value="<?php echo $row['titulo']; ?>">
                    <input id="fol" name="fol" type="hidden" value="<?php echo $row['folio']; ?>">
                    <input id="mot" name="mot" type="hidden" value="<?php echo $row['motivo']; ?>">
                    <input id="fec" name="fec" type="hidden" size="10" value="<?php echo $row['fecha']; ?>">

                    <tr>
                        <td align="center"><?php echo $contador++; ?></td>
                        <td align="center">


                            <?php echo $row['titulo']; ?>


                        </td>
                        <td align="center"><?php echo $row['sub1'], "<br><br>", $row['sub2'], "<br><br>", $row['sub3'], "<br><br>", $row['sub4']; ?></td>
                        <td align="center"><?php echo $row['autor1'], "<br><br>", $row['autor2'], "<br><br>", $row['autor3'], "<br><br>", $row['autor4']; ?></td>
                        <td align="center"><?php echo $row['editorial']; ?></td>
                        <td align="center"><?php echo $row['edicion']; ?></td>
                        <td align="center"><?php echo $row['cat1'], "<br><br>", $row['cat2'], "<br><br>", $row['cat3'], "<br><br>", $row['cat4']; ?></td>
                        <td align="center"><?php echo $row['motivo']; ?></td>
                        <td align="center"><?php echo $row['paginas']; ?></td>
                        <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                        <td align="center"><?php echo $row['folio']; ?></td>
                        <td align="center"><?php
                        
                        echo str_replace('-', '/', date('d-m-Y', strtotime($row['fecha']))); 
                        
                        ?></td>
                        <td align="center"><input type="submit" name="imprimir" value="Imprimir"></td>
                     </form>
                    
                    </tr>
                    <tr>
                        <td colspan="14">
                            <hr size=1 noshade="noshade" color="#052E21">
                        </td>
                    </tr>




                <?php }
            exit; ?>

        </table>

    <?php
    }

    ?>
</body>

</html>