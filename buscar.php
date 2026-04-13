<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
    header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sqlus = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
$resultadous = $mysqli->query($sqlus);
$rowus = $resultadous->fetch_assoc();


$akey = '';
if (!isset($_POST['buscar'])) {
    $_POST['buscar'] = '';
}
if (!isset($_POST['filtro'])) {
    $_POST['filtro'] = '';
}



?>

<html lang="es">
<link rel="stylesheet" href="css/main.css" rel=stylesheet />

<head>
    <title>Biblioteca</title>

    
</head>

<body style="background-color: #F2F2F2;">
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
		<h1>Elige el método de Búsqueda</h1>
		</div2>

		<div1>
		<h2><?php echo 'Bienvenido: <br>' . utf8_decode($rowus['nombre']); ?> 
		<br>
		<br>
		<?php echo 'Matricula: <br>' . utf8_decode($rowus['usuario']); ?>
		<br>
		<br>
		<a href="logout.php"><img src="img/exit.png"></a>
		</h2>
		</div1>

	</div>




    <center>
        <form id="busc" name="busc" method="POST" action="buscar.php">
            <table align="center" border="0">

                <tr>
                    <td align="center" colspan="11">
                        <div id="menubus">
                            <ul>
                                <li>
                                    <div style="line-height: 20px" style="bottom: 1;">
                                        <a href="buscartitulo.php">
                                            <img src="img/icontitu.png">
                                            <h3>Título de Libro</h3>
                                        </a>
                                    </div>

                                </li>
                                <li>
                                <div style="line-height: 20px" style="padding: 10px 0px;">
                                        <a href="buscarsubt.php">
                                            <img src="img/iconsub.png">
                                            <h3>Subtítulo</h3>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                <div style="line-height: 20px" style="padding: 10px 0px;">
                                        <a href="buscarautor.php">
                                            <img src="img/iconaut.png">
                                            <h3>Autor</h3>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                <div style="line-height: 20px" style="padding: 10px 0px;">
                                        <a href="buscareditorial.php">
                                            <img src="img/iconeditorial.png">
                                            <h3>Editorial</h3>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                <div style="line-height: 20px" style="padding: 10px 0px;">
                                        <a href="buscarfolio.php">
                                            <img src="img/iconfol.png">
                                            <h3>Folio</h3>
                                        </a>
                                    </div>
                                </li>
                                <li>

                                <div style="line-height: 20px" style="padding: 10px 0px;">
                                        <a href="categorias.php">
                                            <img src="img/iconcat.png">
                                            <h3>Categorías</h3>
                                        </a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>
                <!--
            <tr>
                <td colspan="11">
                    <hr size=5 noshade="noshade">
                </td>
            </tr>
            
                <tr>
                    <td colspan="2">
                    <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo $_POST["buscar"] ?>">

                    </td>
                    <td>
                        <select id="assigned-tutor-filter" id="filtro" name="filtro" ">
                            <?php if ($_POST["filtro"] != '') { ?>
                            <option value=" <?php echo $_POST["filtro"]; ?>"><?php echo $_POST["filtro"]; ?></option>
                        <?php } ?>
                        <option value="">Elige un metodo de busqueda</option>
                        <option value="titulo">Titulo del Libro</option>
                        <option value="autor1">Autor del Libro</option>
                        <option value="editorial">Editorial del Libro</option>
                        <option value="sub1">Subtitulo del Libro</option>
                        <option value="folio">Folio del Libro</option>
                        </select>

                    </td>
                    <td colspan="2" align="center">
                        <input type="submit" class="btn " value="Buscar">
                    </td>
                </tr>

                <?php





                ?>
            


            <tr>
                <td colspan="11">
                    <hr size=2 noshade="noshade">
                </td>
            </tr>
            </tr>
            <tr>
                <th>
                    <font color='#666666'> N°</font>
                </th>
                <th>
                    <font color='#666666'> Titulo</font>
                </th>
                <th>
                    <font color='#666666'> Subtitulos</font>
                </th>
                <th>
                    <font color='#666666'> Autor</font>
                </th>
                <th>
                    <font color='#666666'> Editorial</font>
                </th>
                <th>
                    <font color='#666666'> Edición</font>
                </th>
                <th>
                    <font color='#666666'> Categoria</font>
                </th>
                <th>
                    <font color='#666666'> Disponibilidad</font>
                </th>
                <th>
                    <font color='#666666'> Paginas</font>
                </th>
                <th>
                    <font color='#666666'> Ubicación</font>
                </th>
                <th>
                    <font color='#666666'> Folio</font>
                </th>
            </tr>
            <tr>
                <td colspan="11">
                    <hr size=2 noshade="noshade">
                </td>
            </tr>
            <?php
            $contador = 1;



            ?> 
            
           
                <tr>
                    <td align="center"><?php echo $contador++; ?></td>
                    <td align="center"><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['sub1'], "<br><br>", $row['sub2'], "<br><br>", $row['sub3'], "<br><br>", $row['sub4']; ?></td>
                    <td><?php echo $row['autor1'], "<br><br>", $row['autor2'], "<br><br>", $row['autor3'], "<br><br>", $row['autor4']; ?></td>
                    <td><?php echo $row['editorial']; ?></td>
                    <td align="center"><?php echo $row['edicion']; ?></td>
                    <td><?php echo $row['cat1'], "<br><br>", $row['cat2'], "<br><br>", $row['cat3'], "<br><br>", $row['cat4']; ?></td>
                    <td align="center"><?php echo $row['disponibilidad']; ?></td>
                    <td align="center"><?php echo $row['paginas']; ?></td>
                    <td align="center"><?php echo $row['ubicacion'], " - ", $row['celda']; ?></td>
                    <td align="center"><?php echo $row['folio']; ?></td>
                </tr>
                <tr>
                    <td colspan="11">
                        <hr size=1 noshade="noshade">
                    </td>
                </tr>
            <?php

            exit;
            ?>
            -->
            </table>
        </form>


    </center>
</body>

</html>