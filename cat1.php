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

$consul = "SELECT * FROM libros WHERE cat1 LIKE 'Administración' OR cat2 LIKE 'Administración' OR cat3 LIKE 
'Administración' OR cat4 LIKE 'Administración'";
$buscador = mysqli_query($mysqli, $consul);
$numero = mysqli_num_rows($buscador);
$contador = 1;



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
    <h1>Administración</h1>
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

        <form name="cat1" action="filtrocat1.php" method="POST" id="cat1">
            <table align="center" border="0">
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="2">
                        <input autocomplete="off" type="text" id="buscar" name="buscar" placeholder="Título del Libro">
                    </td>

                    <td colspan="2" align="center">
                        <input type="submit" name="buscarb" value="Buscar">
                    </td>

                    <td colspan="7" align="right">
                        <h6>Numero total de libros: <?php echo $numero; ?></h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="11">
                        <hr size=5 noshade="noshade" color="#052E21">
                    </td>
                </tr>
        </form>
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
                <h6> Disponibilidad</h6>
            </th>
            <th>
                <h6> Paginas</h6>
            </th>
            <th>
                <h6> Ubicación</h6>
            </th>
            <th>
                <h6> Folio</h6>
            </th>
        </tr>
        <tr>
            <td colspan="11">
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

            <tr>
                <td align="center"><?php echo $contador++; ?></td>
                <td align="center">
                    <form method="POST" action="libroinfo.php" name="ifolib" id="infolib">
                        <input id="tit" name="tit" type="hidden" value="<?php echo $row['titulo']; ?>">
                        <input id="su1" name="su1" type="hidden" value="<?php echo $row['sub1']; ?>">
                        <input id="su2" name="su2" type="hidden" value="<?php echo $row['sub2']; ?>">
                        <input id="su3" name="su3" type="hidden" value="<?php echo $row['sub3']; ?>">
                        <input id="su4" name="su4" type="hidden" value="<?php echo $row['sub4']; ?>">
                        <input id="dis" name="dis" type="hidden" value="<?php echo $row['disponibilidad']; ?>">
                        <input id="catt1" name="catt1" type="hidden" value="<?php echo $row['cat1']; ?>">
                        <input id="catt2" name="catt2" type="hidden" value="<?php echo $row['cat2']; ?>">
                        <input id="catt3" name="catt3" type="hidden" value="<?php echo $row['cat3']; ?>">
                        <input id="catt4" name="catt4" type="hidden" value="<?php echo $row['cat4']; ?>">
                        <input id="au1" name="au1" type="hidden" value="<?php echo $row['autor1']; ?>">
                        <input id="au2" name="au2" type="hidden" value="<?php echo $row['autor2']; ?>">
                        <input id="au3" name="au3" type="hidden" value="<?php echo $row['autor3']; ?>">
                        <input id="au4" name="au4" type="hidden" value="<?php echo $row['autor4']; ?>">
                        <input id="pag" name="pag" type="hidden" value="<?php echo $row['paginas']; ?>">
                        <input id="ed" name="ed" type="hidden" value="<?php echo $row['editorial']; ?>">
                        <input id="ubi" name="ubi" type="hidden" value="<?php echo $row['ubicacion']; ?>">
                        <input id="cel" name="cel" type="hidden" value="<?php echo $row['celda']; ?>">
                        <input id="edi" name="edi" type="hidden" value="<?php echo $row['edicion']; ?>">
                        <input id="fo" name="fo" type="hidden" value="<?php echo $row['folio']; ?>">
                        <input id="idi" name="idi" type="hidden" value="<?php echo $row['id']; ?>">
                        <input id="img" name="img" type="hidden" value="<?php echo $row['img']; ?>">

                        <input type="submit" value="<?php echo $row['titulo']; ?>">

                    </form>
                </td>
                <td align="center"><?php echo $row['sub1'], "<br><br>", $row['sub2'], "<br><br>", $row['sub3'], "<br><br>", $row['sub4']; ?></td>
                <td align="center"><?php echo $row['autor1'], "<br><br>", $row['autor2'], "<br><br>", $row['autor3'], "<br><br>", $row['autor4']; ?></td>
                <td align="center"><?php echo $row['editorial']; ?></td>
                <td align="center"><?php echo $row['edicion']; ?></td>
                <td align="center"><?php echo $row['cat1'], "<br><br>", $row['cat2'], "<br><br>", $row['cat3'], "<br><br>", $row['cat4']; ?></td>
                <td align="center"><?php echo $row['disponibilidad']; ?></td>
                <td align="center"><?php echo $row['paginas']; ?></td>
                <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                <td align="center"><?php echo $row['folio']; ?></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr size=1 noshade="noshade" color="#052E21">
                </td>
            </tr>



        <?php }
        exit; ?>


        </table>


    </center>
</body>

</html>